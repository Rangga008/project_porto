<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prestasi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPrestasi()
    {
        
        $authAdmin = Auth::guard('admin')->user();
        if ($authAdmin->role == 'admin') {
            $prodi = strtolower($authAdmin->prodi);
            $prestasi = Prestasi::join('mahasiswa', 'mahasiswa.id', '=', 'prestasis.mahasiswa_id')
                ->where('status', '=', 'Menunggu Verifikasi')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->select('*', 'prestasis.image AS image', 'prestasis.id AS id')
                ->get();
        } else {
            $prestasi = Prestasi::with('Mahasiswa')->where('status', '=', 'Menunggu Verifikasi')->get();
        }

        /*SQL Join Command
        SELECT mahasiswa.id, mahasiswa.nama, prestasis.judul, prestasis.status, prestasis.image
        FROM prestasi
        INNER JOIN mahasiswa ON mahasiswa.id = prestasis.mahasiswa_id*/

        return view('admin.kelola_prestasi.index', compact('prestasi'));
    }

    public function createPrestasi(Request $request)
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
                    'message' => 'Berhasil mengambil data mahasiswa',
                    'datas' => $formatted_tags
                ]);
            }
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
                'datas'  => $formatted_tags
            ]);
        }
        return view('admin.kelola_prestasi.create');
    }

    public function storePrestasi(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
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

        $prsData = [
            'mahasiswa_id' => $request->mahasiswa_id,
            'judul' => $request->judul,
            'penyelenggara' => $request->penyelenggara,
            'periode' => $request->periode,
            'image' => $fileName,
            'status' => 'Menunggu Verifikasi'
        ];

        Prestasi::insert($prsData);

        return redirect()->route('index.prestasi')->withSuccess('Prestasi berhasil disimpan.');
    }

    public function editPrestasi($id)
    {
        $prestasi = Prestasi::find($id);
        return view('admin.kelola_prestasi.edit', compact('prestasi'));
    }

    public function updatePrestasi(Request $request, $id)
    {
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
            'judul' => $request->judul,
            'penyelenggara' => $request->penyelenggara,
            'periode' => $request->periode,
            'status' => 'Menunggu Verifikasi'
        ];

        $prestasi->update($prsData);

        return redirect()->route('index.prestasi')->with('success', 'Prestasi Berhasil Diubah');
    }

    public function deletePrestasi($id)
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

    public function updatePrestasiStatus($id_prestasi)
    {
        $prsStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update prestasi sesuai id yang dipilih
        Prestasi::where('id', $id_prestasi)
            ->update($prsStatus);

        // model form biasa
        //return redirect()->route('index.prestasi');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectPrestasi($id_prestasi)
    {
        $prsStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update prestasi sesuai id yang dipilih
        Prestasi::where('id', $id_prestasi)
            ->update($prsStatus);

        // return redirect()->route('index.prestasi');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }

}
