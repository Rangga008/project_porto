<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurnal = Jurnal::where('mahasiswa_id', auth()->user()->id)->get();
        return view('mahasiswa.jurnal.index', compact('jurnal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.jurnal.create');
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
            'judul' => 'required',
            'penulis' => 'required',
            'jurnal' => 'required',
            'file' => 'required|mimes:pdf|max:10000',
        ], [
            'image.mimes' => 'Berkas bukan termasuk bentuk pdf',
            'file.max' => 'Ukuran berkas lebih besar dari 10MB'
        ]);

        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/files', $fileName);
        // $file->file=$fileName;
        // $request->file->move('assets', $fileName);

        $jrnlData = [
            'mahasiswa_id' => auth()->user()->id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'jurnal' => $request->jurnal,
            'file' => $fileName,
            'status' => 'Menunggu Verifikasi'
        ];

        Jurnal::insert($jrnlData);

        return redirect()->route('jurnal.index')->withSuccess('Jurnal berhasil disimpan.');
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
        $jurnal = Jurnal::where('id', $id)->first();
        return view('mahasiswa.jurnal.edit', compact('jurnal'));
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
        $jurnal = Jurnal::where('id', $id)->first();
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'jurnal' => 'required',
            'file' => 'mimes:pdf|max:10000',
        ], [
            'file.mimes' => 'Berkas bukan termasuk bentuk pdf',
            'file.max' => 'Ukuran berkas lebih besar dari 10MB'
        ]);
        if ($request->hasFile('file') && $request->file('file') instanceof UploadedFile) {
            
            if (!empty($jurnal->file)) {
                File::delete("storage/files/{$jurnal->file}");
            }
            
            //upload file to storage
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/files', $fileName);

            //upload file to DB
            $jurnal->update(['file' => $fileName,]);

        }

        $jrnlData = [
            'mahasiswa_id' => auth()->user()->id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'jurnal' => $request->jurnal,
            'status' => 'Menunggu Verifikasi'
        ];

        $jurnal->update($jrnlData);

        return redirect()->route('jurnal.index')
            ->withSuccess('Jurnal berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Jurnal::where('id', $id)->delete();

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
