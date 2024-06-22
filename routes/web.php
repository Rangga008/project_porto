<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\PrestasiController as PrestasiControllerAdmin;
use App\Http\Controllers\Admin\ProjectController as ProjectControllerAdmin;
use App\Http\Controllers\Admin\JurnalController as JurnalControllerAdmin;
use App\Http\Controllers\Admin\KegiatanController as KegiatanControllerAdmin;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\guestController;
use App\Models\Mahasiswa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  function () {
    return redirect('/home');
})->name('home');

Route::get('/home', function () {
    return view('home');
});


//Guest
Route::resource('/search', guestController::class);
Route::post('searchPorto', [guestController::class, 'searchPorto'])->name('searchPorto');


//Admin
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('adminLogin');
Route::post('/updatePasswordAdm', [ChangePasswordController::class, 'updatePasswordAdm'])->name('updatePasswordAdm');
Route::group(['middleware' => 'auth:admin'], function () {
    //Route for Dashboard
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    //put -> karena butuh method untuk update
    //verif{id} -> parameter untuk menjalankan function di controllernya
    //updatestatus -> nama method baru di controller
    //name -> alias yang dipake untuk manggil di route


    //Route for CRUD and Verif Prestasi by Admin
    Route::get('/verif_prestasi', [PrestasiControllerAdmin::class, 'indexPrestasi'])->name('index.prestasi');
    Route::put('/acc_prestasi/{id_prestasi}', [PrestasiControllerAdmin::class, 'updatePrestasiStatus'])->name('verif.updatePrestasiStatus');
    Route::put('/tolak_prestasi/{id_prestasi}', [PrestasiControllerAdmin::class, 'rejectPrestasi'])->name('verif.rejectPrestasi');

    Route::get('/verif_prestasi/create', [PrestasiControllerAdmin::class, 'createPrestasi'])->name('admin.create.prestasi');
    Route::post('/verif_prestasi/post', [PrestasiControllerAdmin::class, 'storePrestasi'])->name('admin.store.prestasi');
    Route::get('/verif_prestasi/{id}/edit', [PrestasiControllerAdmin::class, 'editPrestasi'])->name('admin.edit.prestasi');
    Route::put('/verif_prestasi/{id}/update', [PrestasiControllerAdmin::class, 'updatePrestasi'])->name('admin.update.prestasi');
    Route::delete('/verif_prestasi/{id}', [PrestasiControllerAdmin::class, 'deletePrestasi'])->name('admin.delete.prestasi');

    //Route for CRUD and Verif Project by Admin
    Route::get('/verif_project', [ProjectControllerAdmin::class, 'indexProject'])->name('index.project');
    Route::put('/acc_project/{id_project}', [ProjectControllerAdmin::class, 'updateProjectStatus'])->name('verif.updateProjectStatus');
    Route::put('/tolak_project/{id_project}', [ProjectControllerAdmin::class, 'rejectProject'])->name('verif.rejectProject');

    Route::get('/verif_project/create', [ProjectControllerAdmin::class, 'createProject'])->name('admin.create.project');
    Route::post('/verif_project/post', [ProjectControllerAdmin::class, 'storeProject'])->name('admin.store.project');
    Route::get('/verif_project/{id}/edit', [ProjectControllerAdmin::class, 'editProject'])->name('admin.edit.project');
    Route::put('/verif_project/{id}/update', [ProjectControllerAdmin::class, 'updateProject'])->name('admin.update.project');
    Route::delete('/verif_project/{id}', [ProjectControllerAdmin::class, 'deleteProject'])->name('admin.delete.project');

    //Route for CRUD and Verif Jurnal by Admin
    Route::get('/verif_jurnal', [JurnalControllerAdmin::class, 'indexJurnal'])->name('index.jurnal');
    Route::put('/acc_jurnal/{id_jurnal}', [JurnalControllerAdmin::class, 'updateJurnalStatus'])->name('verif.updateJurnalStatus');
    Route::put('/tolak_jurnal/{id_jurnal}', [JurnalControllerAdmin::class, 'rejectJurnal'])->name('verif.rejectJurnal');

    Route::get('/verif_jurnal/create', [JurnalControllerAdmin::class, 'createJurnal'])->name('admin.create.jurnal');
    Route::post('/verif_jurnal/post', [JurnalControllerAdmin::class, 'storeJurnal'])->name('admin.store.jurnal');
    Route::get('/verif_jurnal/{id}/edit', [JurnalControllerAdmin::class, 'editJurnal'])->name('admin.edit.jurnal');
    Route::put('/verif_jurnal/{id}/update', [JurnalControllerAdmin::class, 'updateJurnal'])->name('admin.update.jurnal');
    Route::delete('/verif_jurnal/{id}', [JurnalControllerAdmin::class, 'deleteJurnal'])->name('admin.delete.jurnal');

    //Route for CRUD and Verif Jurnal by Admin
    Route::get('/verif_kegiatan', [KegiatanControllerAdmin::class, 'indexKegiatan'])->name('index.kegiatan');
    Route::put('/acc_kegiatan/{id_kegiatan}', [KegiatanControllerAdmin::class, 'updateKegiatanStatus'])->name('verif.updateKegiatanStatus');
    Route::put('/tolak_kegiatan/{id_kegiatan}', [KegiatanControllerAdmin::class, 'rejectKegiatan'])->name('verif.rejectKegiatan');

    Route::get('/verif_kegiatan/create', [KegiatanControllerAdmin::class, 'createKegiatan'])->name('admin.create.kegiatan');
    Route::post('/verif_kegiatan/post', [KegiatanControllerAdmin::class, 'storeKegiatan'])->name('admin.store.kegiatan');
    Route::get('/verif_kegiatan/{id}/edit', [KegiatanControllerAdmin::class, 'editKegiatan'])->name('admin.edit.kegiatan');
    Route::put('/verif_kegiatan/{id}/update', [KegiatanControllerAdmin::class, 'updateKegiatan'])->name('admin.update.kegiatan');
    Route::delete('/verif_kegiatan/{id}', [KegiatanControllerAdmin::class, 'deleteKegiatan'])->name('admin.delete.kegiatan');

    //Route for kelola_mahasiswa
    Route::resource('/kelola_mahasiswa', MahasiswaController::class);
    //Route::get('/fakultas/{id}/prodi', [MahasiswaController::class, 'findProdi'])->name('mahasiswa.findProdi');

});

//Mahasiswa
Route::get('/login/mahasiswa', [LoginController::class, 'showMahasiswaLoginForm']);
Route::post('/login/mahasiswa', [LoginController::class, 'mahasiswaLogin'])->name('mahasiswaLogin');
Route::get('/register/mahasiswa', [RegisterController::class, 'showMahasiswaRegisterForm']);
Route::post('/register/mahasiswa', [RegisterController::class, 'createMahasiswa']);
Route::post('/updatePasswordMhs', [ChangePasswordController::class, 'updatePasswordMhs'])->name('updatePasswordMhs');
Route::put('/updateProfile/{id}', [MahasiswaController::class, 'updateProfile'])->name('tambahFoto');


Route::group(['middleware' => 'auth:mahasiswa'], function () {
    //Route for Dashboard
    Route::get('/mahasiswa', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    // Route::view('/mahasiswa', 'mahasiswa/dashboard');

    //Route for Prestasi
    route::resource('/prestasi', PrestasiController::class);

    // Route for Projects
    Route::resource('/project', ProjectController::class);

    // Route for Jurnal
    Route::resource('/jurnal', JurnalController::class);

    // Route for Kegiatan
    Route::resource('/kegiatan', KegiatanController::class);

    //Route for Verifikasi
    Route::resource('/verifikasi', VerifikasiController::class);
});


Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/test', function () {
    return view('guest.test');
});
