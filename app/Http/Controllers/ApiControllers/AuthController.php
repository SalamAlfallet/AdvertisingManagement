<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|max:55',
            'lname' => 'required|max:55',
            'location' => 'required|max:55',
            'phone' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($request->password);

        $user = User::create($input);

        $accessToken = $user->createToken('authToken')->accessToken;


        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }
}
