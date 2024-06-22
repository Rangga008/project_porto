<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Kegiatan;
use App\Models\Project;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::where('mahasiswa_id', auth()->user()->id)->get()
            ->where('status', '!=', 'Ditolak');
        // dd($prestasi);
        $project = Project::where('mahasiswa_id', auth()->user()->id)->get()
            ->where('status', '!=', 'Ditolak');
        $jurnal = Jurnal::where('mahasiswa_id', auth()->user()->id)->get()
            ->where('status', '!=', 'Ditolak');
        $kegiatan = Kegiatan::where('mahasiswa_id', auth()->user()->id)->get()
            ->where('status', '!=', 'Ditolak');
        //$jurnal = [];

        return view('mahasiswa.portofolio', compact('prestasi', 'project', 'jurnal', 'kegiatan'));
    }
}
