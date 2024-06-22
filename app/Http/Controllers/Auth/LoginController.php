<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Create a new controller instance.
   *
   * @return void
   */

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
    $this->middleware('guest:admin')->except('logout');
    $this->middleware('guest:mahasiswa')->except('logout');
  }

  public function showAdminLoginForm()
  {
    return view('auth.login', ['url' => 'admin']);
  }

  public function adminLogin(Request $request)
  {
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);
    //nambah session email dan password, get remember: untuk ngasih token
    if (FacadesAuth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

      return redirect()->intended('/admin')->with(['successLogin' => 'Login berhasil!']);
    }
    // return redirect()->back()->with(['danger' => 'Login Gagal']);
    return redirect()->back()->with(['danger' => 'Login Gagal']);
  }

  public function showMahasiswaLoginForm()
  {
    return view('auth.login', ['url' => 'mahasiswa']);
  }

  public function mahasiswaLogin(Request $request)
  {
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);

    if (FacadesAuth::guard('mahasiswa')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

      return redirect()->intended('/mahasiswa')->with(['successLogin' => 'Login berhasil!']);
    }
    return redirect()->back()->with(['danger' => 'Login Gagal']);
  }

}