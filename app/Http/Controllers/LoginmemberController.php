<?php

namespace App\Http\Controllers;

use App\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginmemberController extends Controller
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
    protected $redirectTo = '/konsultasihukum';

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
        return view('frontend.pages.konsultasihukum.login');
    }

    public function login(Request $req)
    {
		$req->validate(
			[
				'uid' => 'required',
				'nama' => 'required'
			],[
         	    'uid.required'  => 'E-Mail tidak boleh kosong',
         	    'nama.required'  => 'Nama tidak boleh kosong'
        	]
        );
        if(!Pengguna::find($req->uid)){
            $pengguna = new Pengguna();
            $pengguna->pengguna_id = $req->uid;
            $pengguna->pengguna_nama = $req->nama;
            $pengguna->pengguna_sandi = Hash::make(123456);
            $pengguna->pengguna_admin = 0;
            $pengguna->save();
			$pengguna->assignRole('member');
        }else{
			$pengguna = Pengguna::findOrFail($req->uid);
            $pengguna->pengguna_nama = $req->nama;
            $pengguna->save();
        }

        $remember = true;

        if (Auth::attempt(['pengguna_id' => $req->uid, 'password' => 123456], $remember)) {
            return redirect("/konsultasihukum");
        }
        return Redirect::back();
    }

    private function username()
    {
        return 'pengguna_id';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('');
    }
}
