<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Project;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class guestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mahasiswa = Mahasiswa::all();
        // return view('guest.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show spesific data
        $mahasiswa = Mahasiswa::where('id', '=', $id)
            ->get();

        $prestasi = Prestasi::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();
        //$prestasi = [];

        // dd($prestasi);
        $project = Project::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();

        $jurnal = Jurnal::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();

        $kegiatan = Kegiatan::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();

        return view('guest.show', compact('mahasiswa', 'prestasi', 'project', 'jurnal', 'kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchPorto(Request $request)
    {
        if($request->ajax()) { // kondisi kalau request ajax
            $name = $request->name;
            $mahasiswa = Mahasiswa::where('nama', 'LIKE','%'.$name.'%')->get();

            // select * from 'mahasiswa' WHERE name LIKE '%$name%';
            $formatted_tags = [];

            if(count($mahasiswa) > 0) {
                foreach ($mahasiswa as $item) {
                    $formatted_tags[] = ['id' => $item->id, 'text' => $item->nama.' - '.$item->fakultas.' - '.$item->prodi];
                }
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data mahasiswa',
                    'datas' => $formatted_tags
                ]);
            }
            return response()->json([
                'status' => 404,
                'message' => 'Mahasiswa tidak ditemukan',
                'datas'  => $formatted_tags
            ]);
        }

        // if ($request->isMethod('post')) {

        //     if ($request->name) {
        //         $name = $request->name;
        //         $mahasiswa = Mahasiswa::where('nama', 'LIKE', '%' . $name . '%')->get();
        //     }
        //     if ($request->fakultas) {
        //         $fakultas = $request->fakultas;
        //         $mahasiswa = Mahasiswa::where('nama', 'LIKE', '%' . $name . '%')->get();
        //     }
        // }
        return view('home');
    }
}
