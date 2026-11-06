<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function show(Request $request, User $user): View
    {
        abort_unless($request->hasValidSignature(), 403);

        return view('auth.accept-invitation', compact('request', 'user'));
    }

    public function accept(Request $request, User $user): RedirectResponse
    {
        abort_unless($request->hasValidSignature(), 403);

        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->forceFill([
            'password' => Hash::make($validated['password']),
            'remember_token' => Str::random(60),
        ])->save();

        return redirect()->route('login')->with('status', 'Your password has been set. You can now sign in.');
    }
}
