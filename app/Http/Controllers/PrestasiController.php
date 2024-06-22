<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestasi = Prestasi::where('mahasiswa_id', auth()->user()->id)->get();
        return view('mahasiswa.prestasi.index', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.prestasi.create');
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
        $request->validate([
            'judul' => 'required',
            'penyelenggara' => 'required',
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
        
        // dd($fileName);

        $prsData = [
            'mahasiswa_id' => auth()->user()->id,
            'judul' => $request->judul,
            'penyelenggara' => $request->penyelenggara,
            'periode' => $request->periode,
            'image' => $fileName,
            'status' => 'Menunggu Verifikasi'
        ];

        Prestasi::insert($prsData);

        return redirect()->route('prestasi.index')->withSuccess('Prestasi berhasil disimpan.');
        //return response()->json(['status' => true, 'message' => 'lol', 'data' => $request]);
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
        $prestasi = Prestasi::where('id', $id)->first();
        return view('mahasiswa.prestasi.edit', compact('prestasi'));
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
        $prestasi = Prestasi::where('id', $id)->first();
        $request->validate([
            'judul' => 'required',
            'penyelenggara' => 'required',
            'periode' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:3000',
        ], [
            'image.image' => 'Berkas harus berupa gambar',
            'image.mimes' => 'Gambar bukan termasuk bentuk jpg, png, jpeg',
            'image.max' => 'Ukuran gambar lebih besar dari 3MB'
        ]);

        if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
            
            if (!empty($prestasi->image)) {
                File::delete("storage/images/{$prestasi->image}");
            }
            // $data['image'] = $this->userRepo->saveCoverImage($request->file('image'));
            
            //upload image to storage
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);

            //upload image to DB
           $prestasi->update(['image' => $fileName,]);

        }

        $prsData = [
            'mahasiswa_id' => auth()->user()->id,
            'judul' => $request->judul,
            'penyelenggara' => $request->penyelenggara,
            'periode' => $request->periode,
            'status' => 'Menunggu Verifikasi'
        ];

        $prestasi->update($prsData);

        return redirect()->route('prestasi.index')
            ->withSuccess('Prestasi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Prestasi::where('id', $id)->delete();

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
