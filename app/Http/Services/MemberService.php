<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Pest\Support\Str;

class MemberService
{
    public function getAllMembers()
    {
        return User::where('parent_id', auth()->user()->id)->paginate(10);
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

        Password::sendResetLink([
            'email' => $user->email
        ]);
    }

    public function update()
    {
        //
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
