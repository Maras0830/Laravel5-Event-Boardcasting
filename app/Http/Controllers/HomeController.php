<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
        srand(time()); // 亂數種子
        $username = 'Client'. rand(1, 100000);

        return view('message', ['username' => $username]);
    }

    public function firingEvents(Request $request)
    {
        $username = $request->get('username');
        $message = $request->get('message');
        $user = [
            'id' => 10001,
            'username' => $username,
        ];
        event(new SendMessage($user, $message));
        return 'message sent';
    }


    public function getPusherMessage()
    {
        $member_id = 10001;// maybe you can make web notification with Auth.

        return view('push')->with(compact('member_id'));
    }
}

