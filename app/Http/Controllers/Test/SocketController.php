<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class SocketController extends Controller
{

    public function __construct(
        Message $message
    )
    {
        $this->message = $message;
    }

    public function index()
    {
        return view('test.socket.index');
    }

    public function newMsg(Request $request)
    {
        $add = [
            'user' => $request->input('user'),
            'content' => $request->input('msg')
        ];
        $result = $this->message->addData($add);
        if (!$result) return response()->json(['res' => false]);

        return response()->json(['res' => true]);
    }
}
