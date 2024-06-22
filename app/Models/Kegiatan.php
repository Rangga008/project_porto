<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory, softDeletes;
    protected $guarded = ['id'];

    protected $with = ['mahasiswa'];

    public $timestamps = false;

    protected $fillable = [
        'jabatan', 'kegiatan', 'periode', 'image', 'status'
      ];

    

    public function Mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
