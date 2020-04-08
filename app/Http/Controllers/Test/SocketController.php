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
        $messages = $this->message->getDataList([], 'get');
        foreach ($messages as $key => $msg) {
            $msg->timeAt = date_format($msg->created_at, "m/d H:i");
        }
        return view('test.socket.index');
    }

    public function getSocketIndexData(Request $request)
    {
        $messages = $this->message->getDataList([], 'get');
        foreach ($messages as $key => $msg) {
            $msg->timeAt = date_format($msg->created_at, "m/d H:i");
        }
        return response()->json(['messages' => $messages]);
    }

    public function newMsg(Request $request)
    {
        Log::info('Post to newMsg~~~~');
        $add = [
            'user' => $request->input('user'),
            'content' => $request->input('msg')
        ];
        $result = $this->message->addData($add);
        if (!$result) return response()->json(['res' => false, 'msg' => '123123']);

        return response()->json(['res' => true, 'msg' => '456456']);
    }
}
