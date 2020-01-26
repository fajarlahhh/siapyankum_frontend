<?php

namespace App\Http\Controllers;

use App\Peraturan;
use App\PeraturanJenis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeraturanController extends Controller
{
    //
	public function index(Request $req)
	{
        $jenisPeraturan =  PeraturanJenis::all();
        $jenis = $req->jenis? $req->jenis: ($jenisPeraturan->count() > 0? $jenisPeraturan->first()->peraturan_jenis_id: '');
        $peraturan = Peraturan::where('peraturan_jenis_id', $jenis)->where('peraturan_judul', 'like', '%'.$req->cari.'%')->paginate(10);
		$peraturan->appends([
			'cari' => $req->cari,
			'jenis' => $jenis]);
		return view('pages.peraturan.dataperaturan.index', [
            'jenisPeraturan' => $jenisPeraturan,
            'data' => $peraturan,
            'i' => ($req->input('page', 1) - 1) * 10,
            'cari' => $req->cari,
            'jenis' => $jenis
        ]);
    }

	public function tambah()
	{
		return view('pages.peraturan.dataperaturan.form')
					->with('back', Str::contains(url()->previous(), ['dataperaturan/tambah', 'dataperaturan/edit'])? '/dataperaturan': url()->previous())
					->with('jenisPeraturan', PeraturanJenis::all())
					->with('aksi', 'Tambah');
	}

	public function do_tambah(Request $req)
	{
		$req->validate(
			[
				'peraturan_judul' => 'required',
				'peraturan_file' => 'required|mimes:pdf',
				'peraturan_jenis_id' => 'required'
			],[
         	   'peraturan_judul.required' => 'Judul tidak boleh kosong',
         	   'peraturan_file.required'  => 'File tidak boleh kosong',
         	   'peraturan_file.mimes'  => 'File harus berbentuk pdf',
         	   'peraturan_jenis_id.required'  => 'Jenis tidak boleh kosong',
        	]
		);
        try
        {
            $file = $req->file('peraturan_file');

            $ext = $file->getClientOriginalExtension();
            $nama_file = $req->get('peraturan_judul').".".$ext;
            $file->move(public_path('upload/peraturan'), $nama_file);

			$peraturan = new Peraturan();
			$peraturan->peraturan_judul = $req->get('peraturan_judul');
			$peraturan->peraturan_jenis_id = $req->get('peraturan_jenis_id');
			$peraturan->peraturan_file = 'upload/peraturan/'.$nama_file;
			$peraturan->operator = Auth::user()->pengguna_nama;
            $peraturan->save();

			return redirect($req->get('redirect')? $req->get('redirect'): 'dataperaturan')
			->with('swal_pesan', 'Berhasil menambah data peraturan '.$req->get('peraturan_judul'))
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
            $file = $req->file('peraturan_file');

            $ext = $file->getClientOriginalExtension();
            $nama_file = $req->get('peraturan_judul').".".$ext;
            unlink('peraturan/'.$nama_file);
			return redirect($req->get('redirect')? $req->get('redirect'): 'dataperaturan')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'error');
		}
	}

	public function hapus($id)
	{
		try{
            $peraturan = Peraturan::findOrFail($id);
            unlink($peraturan->peraturan_file);
			$peraturan->delete();
			return response()->json([
				'swal_pesan' => 'Berhasil menghapus data peraturan '.$peraturan->peraturan_judul,
				'swal_judul' => 'Hapus data',
				'swal_tipe' =>'success',
			]);
		}catch(\Exception $e){
			return response()->json([
				'swal_pesan' => $e->getMessage(),
				'swal_judul' => 'Hapus data',
				'swal_tipe' =>'error',
			]);
		}
	}
}
