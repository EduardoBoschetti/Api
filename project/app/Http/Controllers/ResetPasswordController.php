<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Models\ApiCrud;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $email = $request->input(key:'email');

        if(ApiCrud::where('email', $email)->doesntExist())
        {
            return response(['Erro'=>'Esta EMAIL não esta cadastrado']);
        }

        $token = Str::random(10);

        DB::table(table: 'password_resets')->insert([
            'email' => $email,
            'token' => $token
        ]);

        Mail::send('Forgot', ['token'=>$token], function(Message $message) use($email){
            $message->to($email);
        });
        
        return response(['Check seu email!']);
    }

    public function resetPassword(ResetRequest $request)
    {
        $token = $request->input('token');

        if(!$passwordResets = DB::table('password_resets')->where('token', $token)->first())
        {
            return response(['Sistema'=>'Token Invalido']);
        }

        if(!$user = ApiCrud::where('email', $passwordResets->email)->first())
        {
            return response(['Sistema' =>'Este EMAIL não esta cadastrado!']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        
        return response(['Sistema'=>'Senha alterada com sucesso!']);
    }
}
