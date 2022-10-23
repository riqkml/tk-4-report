<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "staffs";

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

}
