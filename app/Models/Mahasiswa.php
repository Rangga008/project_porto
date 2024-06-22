<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
  use Notifiable, SoftDeletes;

  protected $table = 'mahasiswa';

  protected $guard = 'mahasiswa';

  public $timestamps = false;

  protected $fillable = [
    'nama', 'email', 'password', 'nim', 'fakultas', 'prodi', 'image'
  ];

  protected $hidden = [ 'password' ];
}
