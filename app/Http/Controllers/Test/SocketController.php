<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('Post to newMsg~~~~');
        $add = [
            'user' => $request->input('user'),
            'content' => $request->input('msg')
        ];
        $result = $this->message->addData($add);
        if (!$result) return response()->json(['res' => false]);

        return response()->json(['res' => true]);
    }
}
