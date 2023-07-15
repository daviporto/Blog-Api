<?php

namespace App\Service;


use App\Models\User;
use App\Prototype\RegisterRequestPrototype;
use Illuminate\Support\Facades\Hash;

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
}
