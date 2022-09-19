<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class News extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $table = "news";
    protected $fillable = ['title', 'subtitle', 'content', 'date'];
}
