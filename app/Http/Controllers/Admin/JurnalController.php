<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurnal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJurnal()
    {
        $authAdmin = Auth::guard('admin')->user();
        if ($authAdmin->role == 'admin') {
            $prodi = strtolower($authAdmin->prodi);
            $jurnal = Jurnal::join('mahasiswa', 'mahasiswa.id', '=', 'jurnals.mahasiswa_id')
                ->where('status', '=', 'Menunggu Verifikasi')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->select('*', 'jurnals.id AS id')
                ->get();
        } else {
            $jurnal = Jurnal::with('Mahasiswa')->where('status', '=', 'Menunggu Verifikasi')->get();
        }

        return view('admin.kelola_jurnal.index', compact('jurnal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createJurnal(Request $request)
    {
        if($request->ajax()) { // kondisi kalau request ajax
            $name = $request->name;
            $authAdmin = Auth::guard('admin')->user();
            if ($authAdmin->role == 'admin') {
                $prodi = strtolower($authAdmin->prodi);
                $mahasiswa = Mahasiswa::whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')->where('nama', 'LIKE','%'.$name.'%')->get();
            } else {
                $mahasiswa = Mahasiswa::where('nama', 'LIKE','%'.$name.'%')->get();
            }

            // select * from 'mahasiswa' WHERE name LIKE '%$name%';
            $formatted_tags = [];

            if(count($mahasiswa) > 0) {
                foreach ($mahasiswa as $item) {
                    $formatted_tags[] = ['id' => $item->id, 'text' => $item->nama.' - '.$item->fakultas.' - '.$item->prodi];
                }
                return response()->json([
                    'status' => 200,
                    'message' => 'berhasil mengambil data mahasiswa',
                    'datas' => $formatted_tags
                ]);
            }
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
                'datas'  => $formatted_tags
            ]);
        }
        return view('admin.kelola_jurnal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJurnal(Request $request)
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

        $jrnlData = [
            'mahasiswa_id' => $request->mahasiswa_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'jurnal' => $request->jurnal,
            'file' => $fileName,
            'status' => 'Menunggu Verifikasi'
        ];

        Jurnal::insert($jrnlData);

        return redirect()->route('index.jurnal')->withSuccess('Jurnal berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editJurnal($id)
    {
        $jurnal = Jurnal::find($id);        
        return view('admin.kelola_jurnal.edit', compact('jurnal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateJurnal(Request $request, $id)
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
            'mahasiswa_id' => $request->mahasiswa_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'jurnal' => $request->jurnal,
            'status' => 'Menunggu Verifikasi'
        ];

        $jurnal->update($jrnlData);

        return redirect()->route('index.jurnal')->with('success', 'Jurnal Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteJurnal($id)
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

    public function updateJurnalStatus($id_jurnal)
    {
        $jrnlStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update jurnal sesuai id yang dipilih
        Jurnal::where('id', $id_jurnal)
            ->update($jrnlStatus);

        // model form biasa
        //return redirect()->route('index.jurnal');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectJurnal($id_jurnal)
    {
        $jrnlStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update jurnal sesuai id yang dipilih
        Jurnal::where('id', $id_jurnal)
            ->update($jrnlStatus);

        // return redirect()->route('index.jurnal');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }
}
