<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurnal;
use App\Models\Project;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authAdmin = Auth::guard('admin')->user();
        if ($authAdmin->role == 'admin') {
            $prodi = strtolower($authAdmin->prodi);

            //mahasiswa aktif
            $mahasiswa = Mahasiswa::whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count();

            // prestasi
            $prestasi = [
                'verifikasi' => Prestasi::join('mahasiswa', 'mahasiswa.id', '=', 'prestasis.mahasiswa_id')
                ->where('status', '=', 'Telah diverifikasi')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
                'total' => Prestasi::join('mahasiswa', 'mahasiswa.id', '=', 'prestasis.mahasiswa_id')
                    ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
            ];
            
            //project (v)
            $project = [
                'verifikasi' => Project::join('mahasiswa', 'mahasiswa.id', '=', 'projects.mahasiswa_id')
                    ->where('status', '=', 'Telah diverifikasi')
                    ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
                'total' => Project::join('mahasiswa', 'mahasiswa.id', '=', 'projects.mahasiswa_id')
                    ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
            ];

            //jurnal (v)
            $jurnal = [
                'verifikasi' => Jurnal::join('mahasiswa', 'mahasiswa.id', '=', 'jurnals.mahasiswa_id')
                    ->where('status', '=', 'Telah diverifikasi')
                    ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
                'total' => Jurnal::join('mahasiswa', 'mahasiswa.id', '=', 'jurnals.mahasiswa_id')
                    ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
            ];

            //kegiatan (v)
            $kegiatan = [
                'verifikasi' => Kegiatan::join('mahasiswa', 'mahasiswa.id', '=', 'kegiatans.mahasiswa_id')
                    ->where('status', '=', 'Telah diverifikasi')
                    ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
                'total' => Kegiatan::join('mahasiswa', 'mahasiswa.id', '=', 'kegiatans.mahasiswa_id')
                    ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->count(),
            ];

            //prestasi table 
            $dataPrs = Prestasi::join('mahasiswa', 'mahasiswa.id', '=', 'prestasis.mahasiswa_id')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();
            
            //project table
            $dataPrj = Project::join('mahasiswa', 'mahasiswa.id', '=', 'projects.mahasiswa_id')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();
            
            //jurnal table
            $dataJrnl = Jurnal::join('mahasiswa', 'mahasiswa.id', '=', 'jurnals.mahasiswa_id')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();
            
            //kegiatan table
            $dataKgt = Kegiatan::join('mahasiswa', 'mahasiswa.id', '=', 'kegiatans.mahasiswa_id')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();

        } else {
            //mahasiswa aktif
            $mahasiswa = Mahasiswa::count();

            // prestasi
            $prestasi = [
                'verifikasi' => Prestasi::where('status', 'Telah diverifikasi')->get()->count(),
                'total' => Prestasi::all()->count()
            ]; 

            //project (v)
            $project = [
                'verifikasi' => Project::where('status', 'Telah diverifikasi')->get()->count(),
                'total' => Project::all()->count()
            ];

            //jurnal (v)
            $jurnal = [
                'verifikasi' => Jurnal::where('status', 'Telah diverifikasi')->get()->count(),
                'total' => Jurnal::all()->count()
            ];

            //kegiatan (v)
            $kegiatan = [
                'verifikasi' => Kegiatan::where('status', 'Telah diverifikasi')->get()->count(),
                'total' => Kegiatan::all()->count()
            ];

            //prestasi table 
            $dataPrs = Prestasi::join('mahasiswa', 'mahasiswa.id', '=', 'prestasis.mahasiswa_id')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();

            //project table
            $dataPrj = Project::join('mahasiswa', 'mahasiswa.id', '=', 'projects.mahasiswa_id')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();

            //jurnal table
            $dataJrnl = Jurnal::join('mahasiswa', 'mahasiswa.id', '=', 'jurnals.mahasiswa_id')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();

            //kegiatan table
            $dataKgt = Kegiatan::join('mahasiswa', 'mahasiswa.id', '=', 'kegiatans.mahasiswa_id')
                ->where('status', '=', 'Telah diverifikasi')->take(5)->get();
        }

        return view('admin.dashboard', compact('mahasiswa', 'prestasi', 'dataPrs', 'project', 'dataPrj', 'jurnal', 'dataJrnl', 'kegiatan', 'dataKgt'));
    }

}
