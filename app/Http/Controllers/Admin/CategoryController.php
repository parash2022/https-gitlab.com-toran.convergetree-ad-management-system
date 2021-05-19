<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Term;
use DB;

class CategoryController extends Controller
{
	public function getSubCats(Request $request)
	{

		$categories = Term::where('taxonomy_id', 2)->where('term_id', $request->catid)->orderBy('name', 'ASC')->get();
		$response = [];
		if (!$categories->isEmpty()) {
			foreach ($categories as $cat) {
				$response['_' . $cat->id] = $cat->name;
			}
		}

		echo json_encode($response);
	}

	public static function getSubCategory($id)
	{

		$categories = Term::where('taxonomy_id', 2)->where('term_id', $id)->orderBy('name', 'ASC')->get();
		return $categories;
	}
}
