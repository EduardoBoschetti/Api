<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Mail\UserApiMail;
use App\Models\ApiCrud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApiCrudController extends Controller
{
    
    public function index()
    {
        $data = ApiCrud::all();

        return response()->json($data);
    }

    
    public function store(ApiRequest $request)
    {
        
        $data = ApiCrud::create(array_merge($request->only('name', 'email'),['password' =>hash::make($request->password)]));

        $mail = new UserApiMail;

        Mail::to($request->only('email'))->send($mail);

        return response()->json($data);
    }


    public function show($id)
    {
        return ApiCrud::findOrFail($id);
    }

          
    public function update(ApiUpdateRequest $request, $id)
    {
        $data = ApiCrud::find($id);
        $data->update($request->all());

        return response()->json($data);
    }


    public function destroy($id=null)
    {
        $data = ApiCrud::findOrFail($id);
        $data->delete($id);

        return ['Atualização' => 'O Usuario com o ID '. $id .' foi removido com sucesso...'];
    }
    
}
