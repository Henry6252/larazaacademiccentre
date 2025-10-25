<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    /**
     * Handle the login response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toResponse($request)
    {
        $user = Auth::user();

        // Redirect based on the user's role
        $role = $user->getRoleNames()->first();

        $redirect = match ($role) {
            'admin' => route('admin.dashboard'),
            'tutor' => route('tutor.dashboard'),
            'student' => route('student.dashboard'),
            default => '/dashboard',
        };

        return redirect()->intended($redirect);
    }
}
