<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
  use Notifiable;

  protected $table = 'admin';

  protected $guard = 'admin';

  //berhubungan sama migration
  public $timestamps = false;

  protected $fillable = [
    'nama', 'email', 'password'
  ];

  protected $hidden = [ 'password' ];
}
