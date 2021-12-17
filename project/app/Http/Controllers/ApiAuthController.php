<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiCrud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) 
            abort(401, 'Credenciais invalidas'); 

            $user = ApiCrud::where('email', $request->email)->first();
            $authToken = $user->createToken('auth_token');

            return response()->json(['data'=>['toekn'=>$authToken->plainTextToken]]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();;
    }
}
