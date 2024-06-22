<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = Kegiatan::where('mahasiswa_id', auth()->user()->id)->get();
        return view('mahasiswa.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            'kegiatan' => 'required',
            'periode' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:3000',
        ], [
            'image.image' => 'Berkas harus berupa gambar',
            'image.mimes' => 'Gambar bukan termasuk bentuk jpg, png, jpeg',
            'image.max' => 'Ukuran gambar lebih besar dari 3MB'
        ]);

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $kgtData = [
            'mahasiswa_id' => auth()->user()->id,
            'jabatan' => $request->jabatan,
            'kegiatan' => $request->kegiatan,
            'periode' => $request->periode,
            'image' => $fileName,
            'status' => 'Menunggu Verifikasi'
        ];

        Kegiatan::insert($kgtData);

        return redirect()->route('kegiatan.index')->withSuccess('Kegiatan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::where('id', $id)->first();
        return view('mahasiswa.kegiatan.edit', compact('kegiatan'));
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
        $kegiatan = Kegiatan::where('id', $id)->first(); 
        $request->validate([
            'jabatan' => 'required',
            'kegiatan' => 'required',
            'periode' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:3000',
        ], [
            'image.image' => 'Berkas harus berupa gambar',
            'image.mimes' => 'Gambar bukan termasuk bentuk jpg, png, jpeg',
            'image.max' => 'Ukuran gambar lebih besar dari 3MB'
        ]);

        if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
            
            if (!empty($kegiatan->image)) {
                File::delete("storage/images/{$kegiatan->image}");
            }
            // $data['image'] = $this->userRepo->saveCoverImage($request->file('image'));
            
            //upload image to storage
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);

            //upload image to DB
            $kegiatan->update(['image' => $fileName,]);

        }

        $kgtData = [
            'mahasiswa_id' => auth()->user()->id,
            'jabatan' => $request->jabatan,
            'kegiatan' => $request->kegiatan,
            'periode' => $request->periode,
            'status' => 'Menunggu Verifikasi'
        ];

        $kegiatan->update($kgtData);

        return redirect()->route('kegiatan.index')->withSuccess('Kegiatan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Kegiatan::where('id', $id)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Data berhasil dihapus";
        } else {
            $success = true;
            $message = "Data tidak ditemukan";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
