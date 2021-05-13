<?php

namespace App\Helpers;

use Image;
use Storage;

class Thumbnail
{


	private static function sizes()
	{

		return  [
			'x'	    => [70, 70],
			'xx'    => [400, 300],
			'xxx'   => [600, 400],
			'xxxx'	=> [850, 450],
			'xxxxx' => [1100, 600]
		];
	}

	public static function exist($name, $size = NULL)
	{

		if ($size == NULL || $size == 'full') {

			if (Storage::disk('public')->exists($name)) {

				return true;
			}
		}

		if (Storage::disk('public')->exists(self::resizedImageName($name, $size))) {
			return Storage::disk('public')->url(self::resizedImageName($name, $size));
		} else if (Storage::disk('public')->exists($name)) {

			return Storage::disk('public')->url($name);
		}
		return false;
	}



	public static function url($name, $size = NULL)
	{

		if ($size == NULL || $size == 'full') {

			if (Storage::disk('public')->exists($name)) {

				return Storage::disk('public')->url($name);
			}
		}

		if (Storage::disk('public')->exists(self::resizedImageName($name, $size))) {
			return Storage::disk('public')->url(self::resizedImageName($name, $size));
		} else if (Storage::disk('public')->exists($name)) {

			return Storage::disk('public')->url($name);
		}
		return false;
	}


	public static function handleUpload($encode)
	{

		$path = 'uploads/';

		$path  = $path . date('Y') . '/' . date('m') . '/';
		Storage::makeDirectory($path);

		$storage_path = Storage::disk('public')->path($path);


		if (!is_array($encode)) {
			$files[] = $encode;
		} else {
			$files = $encode;
		}


		$names = [];
		if (is_array($files)) {
			$files = array_filter($files);
			foreach ($files as $file) {
				if (preg_match("/data:image/", $file)) {
					preg_match("/data:image\/(.*?);/", $file, $match);
					if (isset($match[1])) {
						$ext = $match[1];
						$file = preg_replace('/data:image\/(.*?);base64,/', '', $file);
						$file = str_replace(' ', '+', $file);
						$image_name = intval(microtime(true)) . '-' . mt_rand(10000, 1000000) . '.' . $ext;
						$save_path = $path . $image_name;
						Storage::disk('public')->put($save_path, base64_decode($file));
						//check image size
						if (self::validateImageSize(Storage::disk('public')->path($save_path))) {
							$names[] = $save_path;
							//uncomment below line to generate multiple images 
							//self::generate(Storage::disk('public')->path($save_path), $storage_path);
						} else {
							@unlink(Storage::disk('public')->path($save_path));
						}
					}
				} else {
					$names[] = $image;
				}
			}
		}
		if (empty($names)) {
			$names[] = '';
		}
		return $names;
	}

	public static function unlinkUpload($name)
	{

		if (Storage::disk('public')->exists($name)) {

			/* for multiple generated images */

			// $imginfo = explode('.', $name);

			// $file = pathinfo(Storage::disk('public')->url($name));
			// $ext = $file['extension'];

			// $sizes = self::sizes();
			// $keys = array_keys($sizes);

			// foreach($keys as $k){

			// 	$newname = $imginfo[0].'-'.$k.'.'.$imginfo[1];
			// 	Storage::disk('public')->delete($newname);

			// }

			Storage::disk('public')->delete($name);

			return true;
		}
	}


	private static function generate($filepath, $storagepath)
	{

		$sizes     = self::sizes();

		$filename  = pathinfo($filepath, PATHINFO_FILENAME);
		$extension = pathinfo($filepath, PATHINFO_EXTENSION);



		$width = NULL;
		$height = NULL;

		foreach ($sizes as $key => $val) :
			$img = Image::make($filepath);
			if ($val[0]) {
				$width = (int)$val[0];
			}

			if ($val[1]) {
				$height = (int)$val[1];
			}

			$resized   = $storagepath . $filename . '-' . $key . '.' . $extension;

			if ($width && $height) {

				$img->fit($width, $height);
			} else if ($width && !$height) {

				$img->resize($width, NULL, function ($constraint) {
					$constraint->aspectRatio();
				});
			} else if (!$width && $height) {

				$img->resize(NULL, $height, function ($constraint) {
					$constraint->aspectRatio();
				});
			}
			$img->save($resized, 100);
			$img->destroy();
		endforeach;
	}



	private static  function validateImageSize($path)
	{

		$img = Image::make($path);
		$bits = $img->filesize();
		if ($bits <= 5242880) {

			return true;
		}
		return false;
	}

	private static function resizedImageName($name, $size = NULL)
	{

		if (!$name) {
			return false;
		}

		$suffix = '';
		if (($size)) {
			$suffix = '-' . $size;
		}


		$path = substr($name, 0, strrpos($name, '/'));
		$name = substr(strrchr($name, '/'), 1);
		$arr = explode('.', $name);
		if (isset($arr[0])) {
			return $path . '/' . $arr[0] . $suffix . '.' . $arr[1];
		}
		return false;
	}
}
