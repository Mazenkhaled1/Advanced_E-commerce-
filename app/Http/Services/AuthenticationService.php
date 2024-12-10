<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;


class AuthenticationService
{

    public function login (LoginRequest $loginRequest) 
    {
    
        if (Auth::attempt([ 'email' => $loginRequest->email , 'password' => $loginRequest->password]) ) {
            $user = Auth::user();
            $data['token'] = $user->createToken('ApiToken')->plainTextToken;
            $data['name'] = $user->name ; 
            $data['email'] = $user->email ; 
            return $data ; 
        }
    }
}