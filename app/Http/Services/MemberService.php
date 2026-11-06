<?php

namespace App\Http\Services;

use App\Jobs\SendInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberService
{
    public function getAllMembers($userId)
    {
        return User::where('parent_id', $userId)->with('urls')->paginate(10);
    }

    public function store($data,$parentId)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'parent_id' => $parentId,
            'password' => Hash::make(Str::random(64))
        ]);

        $user->assignRole('Member');

        SendInvitation::dispatch($user);
    }

    public function updateMember(User $member, $data)
    {
        return $member->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
        ]);
    }

    public function deleteMember($member, $parentId)
    {
        if(!$member->parent_id){
            return abort(404);
        }

        if($member->parent_id != $parentId){
            return abort(404);
        }

        $member->delete();
    }
}
