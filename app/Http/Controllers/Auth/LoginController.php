<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    }
    
    public function showLoginForm(){
        return view('pages.login');
    }

    public function login(Request $req)
    {
		$req->validate(
			[
				'uid' => 'required',
				'password' => 'required'
			],[
         	    'uid.required'  => 'ID tidak boleh kosong',
         	    'password.required'  => 'Kata Sandi tidak boleh kosong'
        	]
        );

        $remember = ($req->remember == 'on') ? true : false;

        if (Auth::attempt(['pengguna_id' => $req->uid, 'password' => $req->password], $remember)) {

            return redirect()->intended('dashboard')
            ->with('gritter_judul', 'Selamat datang')
            ->with('gritter_teks', 'Selamat bekerja dan semoga sukses')
            ->with('gritter_gambar', '../assets/img/user/user.png');
        }
        return Redirect::back()->withInput()->with('alert', 'ID Pengguna atau Kata Sandi salah');
    }

    private function username()
    {
        return 'pengguna_id';
    }
}
