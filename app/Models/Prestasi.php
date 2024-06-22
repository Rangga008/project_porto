<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestasi extends Model
{
    use HasFactory, softDeletes;
    protected $guarded = ['id'];

    protected $with = ['mahasiswa'];

    public $timestamps = false;

    protected $fillable = [
        'judul', 'penyelenggara', 'periode', 'image', 'status'
      ];

    

    public function Mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
