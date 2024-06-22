<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
   * Change the current password
   * @param Request $request
   * @return Renderable
   */

  public function updatePasswordMhs(Request $request)
  {
    $request->validate([
      'old_password'=>'required|min:6',
      'new_password'=>'required|min:6',
      'confirm_password'=>'required|same:new_password',
    ], [
      'confirm_password.same' => 'Konfirmasi password tidak sesuai'
    ]);

    $mhs_login = auth()->user();
    if(Hash::check($request->old_password, $mhs_login->password)){
      Mahasiswa::where('id', $mhs_login->id)
      ->update([
        'password'=>bcrypt($request->new_password)
      ]);
      return redirect()->back()->withSuccess('Password berhasil diubah');
    }else{
      return redirect()->back()->withErrors('Password tidak sesuai');
    }
  }
  public function updatePasswordAdm(Request $request)
  {
    // $request->validate([
    //   'old_password'=>'required|min:6',
    //   'new_password'=>'required|min:6',
    //   'confirm_password'=>'required',
    // ]);
    
    $adm_login = auth()->user();
    if(Hash::check($request->old_password, $adm_login->password)){
      Admin::where('id', $adm_login->id)
      ->update([
        'password'=>bcrypt($request->new_password)
      ]);

      return redirect()->back()->withSuccess('Password berhasil diubah');
    }else{
      return redirect()->back()->withDanger('');
    }
  }
}
