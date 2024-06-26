<?php

namespace App\Http\Controllers\Chats;

use App\Events\SendMessageEvents;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendMessageRequest;
use App\Models\Chatmessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function user_list()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $data = $this->getImageUrl($users, 'photo');
        if ($users) {
            return $data;
        }
    }


    public function user_message($id)
    {
        $user = User::findOrFail($id);
        $user['photo'] = $user->photo ? $user->imageUrl() : '';
        $messages = $this->message_by_user($id);
        $read = $this->update_message_by_user($id);
        return response()->json([
            'messages' => $messages,
            'user'     => $user,
            'read' => $read,
        ]);
    }

    public function send_message(SendMessageRequest $request)
    {
        $data = $request->validated();
        $message = Chatmessage::create($data);
        SendMessageEvents::dispatch($message);
        return response()->json([
            'messages' => $message,
        ]);
    }

    public function userMessageCurrent()
    {
        $data = Chatmessage::select('id_receive')->with('user_receive')->distinct()
            ->where('id_send', auth()->user()->id)
            ->get();
        $data1 = Chatmessage::select('id_send')->with('user_send')->distinct()
            ->where('id_receive', auth()->user()->id)
            ->get();

        $usersWithLastMessage = $this->dataCurrentMessage($data, 'user_receive');
        $messagesRecu = $this->dataCurrentMessage($data1, 'user_send');

        // dd(json_encode($data), json_encode($data1));
        return response()->json([
            'Usermessages' => $usersWithLastMessage,
            'messageeRecu' => $messagesRecu
        ]);
    }
    public function dataCurrentMessage($data , $jointure){
       return $data->map(function ($items) use ($jointure){
            return [
                "id" => $items->$jointure->id,
                "username" => $items->$jointure->username,
                "email" => $items->$jointure->email,
                "type" => $items->$jointure->type,
                "photo" =>  $items->$jointure->photo == null ? '' : $items->$jointure->imageUrl(),
                "id_etudiant" => $items->$jointure->id_etudiant,
            ];
        })->values();
    }

    public function message_by_user($user_id)
    {
        $messages = Chatmessage::where(function ($q) use ($user_id) {
            $q->where('id_send', auth()->user()->id);
            $q->where('id_receive', $user_id);
        })->orWhere(function ($q) use ($user_id) {
            $q->where('id_send', $user_id);
            $q->where('id_receive', auth()->user()->id);
        })->get();

        return $messages;
    }
    public function update_message_by_user($user_id)
    {
        $messages = Chatmessage::where(function ($q) use ($user_id) {
            $q->where('id_send', auth()->user()->id);
            $q->where('id_receive', $user_id);
        })->orWhere(function ($q) use ($user_id) {
            $q->where('id_send', $user_id);
            $q->where('id_receive', auth()->user()->id);
        })->update(['read' => 1]);

        return $messages;
    }
    public function getImageUrl($data, $name)
    {
        foreach ($data as $item) {
            $item[$name] = $item->$name == '' ? '' : $item->imageUrl();
        }
        return $data;
    }
}
