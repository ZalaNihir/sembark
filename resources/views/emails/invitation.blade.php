@component('mail::message')
# You’re invited to {{ $companyName }}

Hello {{ $user->name }},

@if ($isAdmin)
You’ve been invited to join **{{ $companyName }}** as a company admin. As an admin, you’ll be able to manage your company’s Sembark account and its members.
@else
You’ve been invited to join **{{ $companyName }}** as a member. Your company admin has assigned you access to the company’s Sembark account.
@endif

Use the email address below to sign in. Set your password with the button, then you can log in to Sembark.

@component('mail::panel')
**Company:** {{ $companyName }}  
**Role:** {{ $isAdmin ? 'Company admin' : 'Member' }}  
**Login email:** {{ $user->email }}
@endcomponent

@component('mail::button', ['url' => $acceptUrl])
Set your password
@endcomponent

This invitation link expires in seven days. If you weren’t expecting this invitation, you can ignore this email.

Thanks,  
{{ config('app.name') }}
@endcomponent
