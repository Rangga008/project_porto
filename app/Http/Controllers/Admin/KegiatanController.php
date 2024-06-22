<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexKegiatan()
    {
        $authAdmin = Auth::guard('admin')->user();
        if ($authAdmin->role == 'admin') {
            $prodi = strtolower($authAdmin->prodi);
            $kegiatan = Kegiatan::join('mahasiswa', 'mahasiswa.id', '=', 'kegiatans.mahasiswa_id')
                ->where('status', '=', 'Menunggu Verifikasi')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->select('*', 'kegiatans.image AS image', 'kegiatans.id AS id')
                ->get();
        } else {
            $kegiatan = Kegiatan::with('Mahasiswa')->where('status', '=', 'Menunggu Verifikasi')->get();
        }

        return view('admin.kelola_kegiatan.index', compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createKegiatan(Request $request)
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
        return view('admin.kelola_kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeKegiatan(Request $request)
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
            'mahasiswa_id' => $request->mahasiswa_id,
            'jabatan' => $request->jabatan,
            'kegiatan' => $request->kegiatan,
            'periode' => $request->periode,
            'image' => $fileName,
            'status' => 'Menunggu Verifikasi'
        ];

        Kegiatan::insert($kgtData);

        return redirect()->route('index.kegiatan')->withSuccess('Kegiatan berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editKegiatan($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('admin.kelola_kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateKegiatan(Request $request, $id)
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

        return redirect()->route('index.kegiatan')->with('success', 'Kegiatan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteKegiatan($id)
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
    
    public function updateKegiatanStatus($id_kegiatan)
    {
        $kgtStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update kegiatan sesuai id yang dipilih
        Kegiatan::where('id', $id_kegiatan)
            ->update($kgtStatus);

        // model form biasa
        //return redirect()->route('index.kegiatan');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectKegiatan($id_kegiatan)
    {
        $kgtStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update kegiatan sesuai id yang dipilih
        Kegiatan::where('id', $id_kegiatan)
            ->update($kgtStatus);

        // return redirect()->route('index.kegiatan');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }
}
