<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Http\Services\MemberService;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct(protected MemberService $memberService)
    {}

    public function index()
    {
        $members  = $this->memberService->getAllMembers();

        return view('members.index',compact('members'));
    }

    public function create(){
        return view('members.create');
    }

    public function store(MemberRequest $request)
    {
        $this->memberService->store($request->all(),auth()->id());

        return redirect()->route('members.index')->with('success','Member created successfully.');
    }

    public function edit(User $member)
    {
        if(!$member->parent_id){
            return abort(404);
        }

        if($member->parent_id != auth()->id()){
            return abort(404);
        }

        return view('members.edit',compact('member'));
    }

    public function update()
    {
        //
    }

    public function destroy(User $member){

        $this->memberService->deleteMember($member, auth()->id());

        return redirect()->route('members.index')->with('success','Member deleted');
    }
}
