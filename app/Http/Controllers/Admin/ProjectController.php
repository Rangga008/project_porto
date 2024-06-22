<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProject()
    {
        $authAdmin = Auth::guard('admin')->user();
        if ($authAdmin->role == 'admin') {
            $prodi = strtolower($authAdmin->prodi);
            $project = Project::join('mahasiswa', 'mahasiswa.id', '=', 'projects.mahasiswa_id')
                ->where('status', '=', 'Menunggu Verifikasi')
                ->whereRaw('LOWER(`prodi`) LIKE ? ','%'.strtolower($prodi).'%')
                ->select('*', 'projects.image AS image', 'projects.id AS id')
                ->get();
        } else {
            $project = Project::with('Mahasiswa')->where('status', '=', 'Menunggu Verifikasi')->get();
        }

        return view('admin.kelola_project.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProject(Request $request)
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
        return view('admin.kelola_project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProject(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:3000',
        ], [
            'image.image' => 'Berkas harus berupa gambar',
            'image.mimes' => 'Gambar bukan termasuk bentuk jpg, png, jpeg',
            'image.max' => 'Ukuran gambar lebih besar dari 3MB'
        ]);

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $prjData = [
            'mahasiswa_id' => $request->mahasiswa_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $fileName,
            'status' => 'Menunggu Verifikasi'
        ];

        Project::insert($prjData);

        return redirect()->route('index.project')->withSuccess('Project berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProject($id)
    {
        $project = Project::find($id);
        return view('admin.kelola_project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProject(Request $request, $id)
    {
        $project = Project::where('id', $id)->first();
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:3000',
        ], [
            'image.image' => 'Berkas harus berupa gambar',
            'image.mimes' => 'Gambar bukan termasuk bentuk jpg, png, jpeg',
            'image.max' => 'Ukuran gambar lebih besar dari 3MB'
        ]);

        if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {

            if (!empty($project->image)) {
                File::delete("storage/images/{$project->image}");
            }
            // $data['image'] = $this->userRepo->saveCoverImage($request->file('image'));

            //upload image to storage
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);

            //upload image to DB
            $project->update(['image' => $fileName,]);
        }

        $prjData = [
            'mahasiswa_id' => $request->mahasiswa_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Menunggu Verifikasi'
        ];

        $project->update($prjData);

        return redirect()->route('index.project')->with('success', 'Project Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProject($id)
    {
        $delete = Project::where('id', $id)->delete();

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

    public function updateProjectStatus($id_project)
    {
        $prjStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update project sesuai id yang dipilih
        Project::where('id', $id_project)
            ->update($prjStatus);

        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectProject($id_project)
    {
        $prjStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update project sesuai id yang dipilih
        Project::where('id', $id_project)
            ->update($prjStatus);

        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }
}
