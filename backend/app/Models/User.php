<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{

    protected $primaryKey = 'idUser';
    public $timestamps = false;
    protected $table = "user";
    protected $fillable = ['email', 'password', 'name'];

}

?>