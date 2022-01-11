<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Mail\IdMail;
use App\Mail\UserApiMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ApiCrud;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dataUser(Request $request)
    {        
        $id = $request->input(key:'id');

        if(ApiCrud::where('id', $id)->doesntExist())
        {
            return ['Sistema' => 'Este ID não existe'];
        }
        
            
            $email = ApiCrud::findOrFail($id);

            $mail = new UserApiMail;
            
            Mail::to($email->only('email'))->send($mail);            

            return ['Sistema' => 'Check seu email'];
    }

    public function dataUserNew($id)
    {
        $data = ApiCrud::findOrFail($id);
        $email = $data->email;
        $name = $data->name;
        $created = $data->created_at;
        $lang ='en';

        App::setLocale($lang);
                    
        Mail::send('teste', ['name'=>$name, 'email'=>$email, 'created'=>$created], function(Message $message) use($email){
            $message->to($email);
        });            

            return ['Sistema' => 'Check seu email'];
    }       
    
}
