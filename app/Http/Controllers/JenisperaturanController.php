<?php

namespace App\Http\Controllers;

use App\PeraturanJenis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class JenisperaturanController extends Controller
{
    //
	public function index(Request $req)
	{
		switch ($req->tipe) {
			case '0':
				$jenis = PeraturanJenis::where('peraturan_jenis_nama', 'like', '%'.$req->cari.'%')
								->orderBy('peraturan_jenis_nama')->paginate(10);
				break;
			case '1':
				$jenis = PeraturanJenis::onlyTrashed()->orderBy('peraturan_jenis_nama')->paginate(10);
				break;
			case '2':
				$jenis = PeraturanJenis::withTrashed()->where('peraturan_jenis_nama', 'like', '%'.$req->cari.'%')
								->orderBy('peraturan_jenis_nama')->paginate(10);
				break;

			default:
				$jenis = PeraturanJenis::where('peraturan_jenis_nama', 'like', '%'.$req->cari.'%')
								->orderBy('peraturan_jenis_nama')->paginate(10);
				break;
		}
		$jenis->appends([
			'cari' => $req->cari,
			'tipe' => $req->tipe
			]);
		return view('pages.peraturan.jenisperaturan.index', [
            'data' => $jenis,
            'i' => ($req->input('page', 1) - 1) * 10,
            'cari' => $req->cari,
            'tipe' => $req->tipe,
        ]);
    }

	public function tambah()
	{
		return view('pages.peraturan.jenisperaturan.form',[
            'back' => Str::contains(url()->previous(), ['jenisperaturan/tambah', 'jenisperaturan/edit'])? '/jenisperaturan': url()->previous(),
            'aksi' => 'Tambah'
        ]);
	}

	public function do_tambah(Request $req)
	{
		$req->validate(
			[
                'peraturan_jenis_nama' => 'required'
			],[
         	    'peraturan_jenis_nama.required' => 'Nama tidak boleh kosong'
        	]
		);
		try{
			$jenis = new PeraturanJenis();
			$jenis->peraturan_jenis_nama = $req->get('peraturan_jenis_nama');
            $jenis->save();

			return redirect($req->get('redirect')? $req->get('redirect'): 'jenisperaturan')
			->with('swal_pesan', 'Berhasil menambah data jenis '.$req->get('peraturan_jenis_nama'))
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'jenis')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'error');
		}
	}

	public function edit($id)
	{
		try{
			;
			return view('pages.peraturan.jenisperaturan.form', [
                'data' => PeraturanJenis::findOrFail($id),
                'back' => Str::contains(url()->previous(), ['jenisperaturan/tambah', 'jenisperaturan/edit'])? '/jenisperaturan': url()->previous(),
                'aksi' => 'Edit'
            ]);
		}catch(\Exception $e){
			return redirect('jenisperaturan')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function do_edit(Request $req)
	{
		$req->validate(
			[
				'peraturan_jenis_nama' => 'required'
			],[
         	   'peraturan_jenis_nama.required' => 'Nama tidak boleh kosong'
        	]
		);
		try{
			$jenis = PeraturanJenis::findOrFail($req->get('peraturan_jenis_id'));
			$jenis->peraturan_jenis_nama = $req->get('peraturan_jenis_nama');
			$jenis->save();
			return redirect($req->get('redirect')? $req->get('redirect'): 'jenisperaturan')
			->with('swal_pesan', 'Berhasil mengedit data jenis '.$req->get('peraturan_jenis_nama'))
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'jenisperaturan')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function hapus($id)
	{
		try{
            $jenis = PeraturanJenis::findOrFail($id);
			$jenis->delete();
			return response()->json([
				'swal_pesan' => 'Berhasil menghapus data jenis peraturan '.$jenis->peraturan_jenis_nama,
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

	public function hapus_permanen($id)
	{
		try{
            $jenis = PeraturanJenis::withTrashed()->findOrFail($id);
			$jenis->forceDelete();
			return response()->json([
				'swal_pesan' => 'Berhasil menghapus secara permanen data jenis peraturan '.$jenis->peraturan_jenis_nama,
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

	public function restore($id)
	{
		try{
            $jenis = PeraturanJenis::withTrashed()->findOrFail($id);
			$jenis->restore();
			return response()->json([
				'swal_pesan' => 'Berhasil merestore data jenis peraturan '.$jenis->peraturan_jenis_nama,
				'swal_judul' => 'Restore data',
				'swal_tipe' =>'success',
			]);
		}catch(\Exception $e){
			return response()->json([
				'swal_pesan' => $e->getMessage(),
				'swal_judul' => 'Restore data',
				'swal_tipe' =>'error',
			]);
		}
	}
}
