<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiCrud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //Check email

        $user = ApiCrud::where('email', $request->email)->first();

        //Check password

        if(!Hash::check($request->password, $user->password))
        {
            return response([
                'Sistema' => 'Credenciais Invalidas'
            ],401);
        }

            $authToken = $user->createToken('api_token')->plainTextToken;

            return response()->json(['data'=>['token'=>$authToken]]);
    }   

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();;

        return ['Sistema'=>['Voce foi delogado com sucesso!']];
    }
}
