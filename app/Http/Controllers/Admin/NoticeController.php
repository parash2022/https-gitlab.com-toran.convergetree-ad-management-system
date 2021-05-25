<?php

namespace App\Http\Controllers\Admin;

use App\Notice;
use App\AppUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Http\Requests\NoticeRequest;


class NoticeController extends Controller
{
    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * The Expo Api Url that will receive the requests
     */
    const EXPO_API_URL = 'https://exp.host/--/api/v2/push/send';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notices = Notice::orderBy('created_at', 'DESC')->paginate(10);
        return view('administrator.notification.view', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeRequest $request)
    {
        $notice             = new Notice;
        //$notice->recipient  = $request->recipient;
        $notice->title      = $request->title;
        $notice->body       = $request->message;
        $notice->user_id    = Auth::user()->id;
        $notice->save();

        $response = true;
        $message = '';
        $success = 0;
        $failed = 0;

        if ($notice) {

            $data   = ['sound' => 'default', 'title' => $request->title, 'body' => $request->message, 'data' => ['slug' => $request->slug]];

            $appUser = AppUser::all();
            if (!$appUser->isEmpty()) {

                foreach ($appUser as $user) {

                    $postData = ['to' => $user->deviceID] + $data;

                    $response   = $this->_sendNotification($postData);

                    $response   = json_decode($response);
                    $status     = $response->status;
                    $message    .= "<br />" . $response->message;

                    $success    = ($status == true) ? $success + 1 : $success + 0;
                    $failed     = ($status == false) ? $failed + 1 : $failed + 0;
                }
            }

            $finalMessage = "Total success:" . $success . "<br /> Total Failed:" . $failed . " <br />" . $message;

            $msgClass = ($response == true) ? 'success' : 'danger';

            $notice = Notice::find($notice->id);
            $notice->status = true;
            $notice->response = $finalMessage;
            $notice->save();

            $msg = ($response == true) ? 'Notification has been pushed!' : 'Push Notification failed!';
        }

        return redirect()->route('administrator.notification.create')->with(['alert' => ['class' => $msgClass, 'msg' => __($msg)]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        //
    }

    /**
     * Registered App User list
     */
    public function appUser()
    {

        $users = AppUser::orderBy('created_at', 'DESC')->paginate(10);

        return view('administrator.appuser.view', compact('users'));
    }

    /**
     * Push Notification 
     */
    public function _sendNotification($data)
    {
        $response = $this->client->request('POST', self::EXPO_API_URL, [
            // 'headers' => [
            //     'accept' => 'application/json',
            //     'Content-type' => 'application/json'
            // ],
            'json' => [$data]
        ]);

        //$response->getHeaderLine('content-type');

        $results = $response->getBody();
        $results = json_decode($results);

        // return response()->json($results);

        $data    = $results->data;

        $status = true;
        $message = '';

        foreach ($data as $d) {

            $status     = ($d->status == 'ok') ? 1 : 0;

            $message = ($status == 1) ? $d->id : $d->message . '. <br /> ' . $d->details->error;
        }

        $data = ['status' => $status, 'message' => $message];


        return json_encode($data);
    }
}
