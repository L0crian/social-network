<?php
namespace App\Traits;

use App\Friendship;

trait Friendable
{
    public function add_friend($user_requested_id)
    {
        $friendship = Friendship::create([
            'user_requested' => $user_requested_id,
            'requester' => $this->id
        ]);

        if($friendship)
        {
            return response()->json($friendship, 200);
        }
        return response()->json('Fail', 501);
    }

    public function accept_friend($requester)
    {
        $friendship = Friendship::where('requester', $requester)
            ->where('user_requested', $this->id)->first();

        if($friendship)
        {
            $friendship->update([
                'status' => 1
            ]);

            return response()->json('ok', 200);
        }

        return response()->json('Fail update', 501);
    }

    public function friends()
    {
        $friends = array();

        $f1 = Friendship::where('status', 1)
            ->where('requester', $this->id)
            ->get();
        foreach ($f1 as $friendship):
            array_push($friends, \App\User::find($friendship->user_requested));
        endforeach;
        $friends2 = array();

        $f2 = Friendship::where('status', 1)
            ->where('user_requested', $this->id)
            ->get();
        foreach ($f2 as $friendship):
            array_push($friends2, \App\User::find($friendship->requester));
        endforeach;
        return array_merge($friends, $friends2);
    }
}