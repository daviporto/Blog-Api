<?php

namespace App\Service;


use App\Mail\UserForgotPassword;
use App\Models\User;
use App\Prototype\RegisterRequestPrototype;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserService
{
    public function createUser(RegisterRequestPrototype $prototype): void
    {
        User::create([
            'name' => $prototype->getName(),
            'email' => $prototype->getEmail(),
            'phone' => $prototype->getPhone(),
            'password' => Hash::make($prototype->getPassword())
        ]);
    }

    public function forgotPassword(User $user): void
    {
        Mail::send(new UserForgotPassword($user));
    }

}
