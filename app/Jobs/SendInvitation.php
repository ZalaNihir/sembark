<?php

namespace App\Jobs;

use App\Mail\InvitationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function handle(): void
    {
        $acceptUrl = URL::temporarySignedRoute(
            'invitation.accept',
            now()->addDays(7),
            ['user' => $this->user->getKey()]
        );

        $isAdmin = $this->user->hasRole('Admin');
        $company = $this->user->company;

        if (! $company && $this->user->parent_id) {
            $company = $this->user->parent?->company;
        }

        Mail::to($this->user->email)->send(new InvitationMail(
            $this->user,
            $acceptUrl,
            $company?->name ?? 'Sembark',
            $isAdmin,
        ));
    }
}
