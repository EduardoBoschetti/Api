<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;





class ApiCrud extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'api_cruds';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
