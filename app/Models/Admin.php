<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;
  use SoftDeletes;

    protected $guard = 'admin';

    protected $dates = ['deleted_at'];

    protected $fillable = [
      'name',
      'email',
      'password',
  ];

  
  protected $hidden = [
      'password',
      'remember_token',
  ];

 
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];
}
