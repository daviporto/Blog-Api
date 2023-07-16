<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required',
             Password::min(6)->letters()->mixedCase()->numbers()],
        ]);
        try{
            $validator->validate();
        }catch(Exception $e){
            return response()->json(['error' => 'senha invalida'], 422);
        }
        
        $dados = $request->all();
        $dados['password'] = Hash::make($request->password);

         try{
            return User::create($dados);
        }catch(Exception $e){
            return response()->json(['error' => 'email ja esta em uso'], 422);
        }
    }
}
