<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\PendapatSaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\PendapatSaranProses;
use Illuminate\Support\Facades\Auth;

class PendapatsaranhukumController extends Controller
{
    //
	public function index(Request $req)
	{
        $pendapatsaranhukum = PendapatSaran::with(['proses' => function($q) {
			$q->orderBy('created_at', 'desc');
		}])->where('pendapat_saran_judul', 'like', '%'.$req->cari.'%')->orWhere('pendapat_saran_laporan_nomor', 'like', '%'.$req->cari.'%')->paginate(10);
		$pendapatsaranhukum->appends([
			'cari' => $req->cari
			]);
		return view('pages.pendapatsaranhukum.index', [
            'data' => $pendapatsaranhukum,
            'i' => ($req->input('page', 1) - 1) * 10,
            'cari' => $req->cari
        ]);
    }

	public function tambah()
	{
		return view('pages.pendapatsaranhukum.form',[
            'back' => Str::contains(url()->previous(), ['pendapatsaranhukum/tambah', 'pendapatsaranhukum/edit', 'pendapatsaranhukum/proses'])? '/pendapatsaranhukum': url()->previous(),
            'aksi' => 'Tambah'
        ]);
	}

	public function do_tambah(Request $req)
	{
		$req->validate(
			[
                'pendapat_saran_judul' => 'required',
                'pendapat_saran_tanggal' => 'required',
                'pendapat_saran_laporan_nomor' => 'required',
                'pendapat_saran_proses_deskripsi' => 'required'
			],[
                'pendapat_saran_judul.required' => 'Judul tidak boleh kosong',
                'pendapat_saran_tanggal.required' => 'Tanggal tidak boleh kosong',
                'pendapat_saran_laporan_nomor.required' => 'Nomor tidak boleh kosong',
                'pendapat_saran_proses_deskripsi.required' => 'Deskripsi tidak boleh kosong'
        	]
		);
		try{
			$pendapatsaranhukum = new PendapatSaran();
			$pendapatsaranhukum->pendapat_saran_judul = $req->get('pendapat_saran_judul');
			$pendapatsaranhukum->pendapat_saran_tanggal = Carbon::parse($req->get('pendapat_saran_tanggal'))->format('Y-m-d');
			$pendapatsaranhukum->pendapat_saran_laporan_nomor = $req->get('pendapat_saran_laporan_nomor');
			$pendapatsaranhukum->operator = Auth::user()->pengguna_nama;
            $pendapatsaranhukum->save();

            $proses = new PendapatSaranProses();
			$proses->pendapat_saran_id = $pendapatsaranhukum->pendapat_saran_id;
			$proses->pendapat_saran_proses_status = 'LAPORAN MASUK';
			$proses->pendapat_saran_proses_deskripsi = $req->get('pendapat_saran_proses_deskripsi');
			$proses->pendapat_saran_proses_tanggal = Carbon::parse($req->get('pendapat_saran_tanggal'))->format('Y-m-d');
			$proses->operator = Auth::user()->pengguna_nama;
            $proses->save();

			return redirect($req->get('redirect')? $req->get('redirect'): 'pendapatsaranhukum')
			->with('swal_pesan', 'Berhasil menambah data pendapat saran hukum '.$req->get('pendapat_saran_judul'))
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'pendapatsaranhukum')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'error');
		}
	}

	public function edit($id)
	{
		try{
			return view('pages.pendapatsaranhukum.form', [
                'data' => PendapatSaran::findOrFail($id),
                'back' => Str::contains(url()->previous(), ['pendapatsaranhukum/tambah', 'pendapatsaranhukum/edit', 'pendapatsaranhukum/proses'])? '/pendapatsaranhukum': url()->previous(),
                'aksi' => 'Edit'
            ]);
		}catch(\Exception $e){
			return redirect(url()->previous()? url()->previous(): 'pendapatsaranhukum')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function do_edit(Request $req)
	{
		$req->validate(
			[
                'pendapat_saran_judul' => 'required',
                'pendapat_saran_tanggal' => 'required',
                'pendapat_saran_laporan_nomor' => 'required'
			],[
                'pendapat_saran_judul.required' => 'Judul tidak boleh kosong',
                'pendapat_saran_tanggal.required' => 'Tanggal tidak boleh kosong',
                'pendapat_saran_laporan_nomor.required' => 'Nomor tidak boleh kosong'
        	]
		);
		try{
			$pendapatsaranhukum = PendapatSaran::findOrFail($req->get('pendapat_saran_id'));
			$pendapatsaranhukum->pendapat_saran_judul = $req->get('pendapat_saran_judul');
			$pendapatsaranhukum->pendapat_saran_tanggal = Carbon::parse($req->get('pendapat_saran_tanggal'))->format('Y-m-d');
			$pendapatsaranhukum->pendapat_saran_laporan_nomor = $req->get('pendapat_saran_laporan_nomor');
			$pendapatsaranhukum->operator = Auth::user()->pengguna_nama;
			$pendapatsaranhukum->save();
			return redirect($req->get('redirect')? $req->get('redirect'): 'pendapatsaranhukum')
			->with('swal_pesan', 'Berhasil mengedit data pendapat saran hukum '.$req->get('pendapat_saran_judul'))
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'pendapatsaranhukum')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function proses($id)
	{
		try{
			return view('pages.pendapatsaranhukum.proses', [
                'data' => PendapatSaran::with(['proses' => function($q) {
					$q->orderBy('created_at', 'asc');
				}])->findOrFail($id),
                'back' => Str::contains(url()->previous(), ['pendapatsaranhukum/tambah', 'pendapatsaranhukum/edit', 'pendapatsaranhukum/proses'])? '/pendapatsaranhukum': url()->previous(),
                'aksi' => 'Proses'
            ]);
		}catch(\Exception $e){
			return redirect(url()->previous()? url()->previous(): 'pendapatsaranhukum')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function do_proses(Request $req)
	{
		$req->validate(
			[
                'pendapat_saran_id' => 'required',
                'pendapat_saran_proses_status' => 'required',
                'pendapat_saran_proses_deskripsi' => 'required',
                'pendapat_saran_proses_tanggal' => 'required'
			],[
                'pendapat_saran_id.required' => 'No. Laporan tidak boleh kosong',
                'pendapat_saran_proses_status.required' => 'Status tidak boleh kosong',
                'pendapat_saran_proses_deskripsi.required' => 'Deskripsi tidak boleh kosong',
                'pendapat_saran_proses_tanggal.required' => 'Tanggal tidak boleh kosong'
        	]
		);
		try{
            $proses = new PendapatSaranProses();
			$proses->pendapat_saran_id = $req->pendapat_saran_id;
			$proses->pendapat_saran_proses_status = $req->get('pendapat_saran_proses_status');
			$proses->pendapat_saran_proses_deskripsi = $req->get('pendapat_saran_proses_deskripsi');
			$proses->pendapat_saran_proses_tanggal = Carbon::parse($req->get('pendapat_saran_proses_tanggal'))->format('Y-m-d');
			$proses->operator = Auth::user()->pengguna_nama;
            $proses->save();
			return redirect($req->get('redirect')? $req->get('redirect'): 'pendapatsaranhukum')
			->with('swal_pesan', 'Berhasil menambah data proses pendapat saran hukum '.$req->get('pendapat_saran_judul'))
			->with('swal_judul', 'Proses data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'pendapatsaranhukum')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Proses data')
			->with('swal_tipe', 'error');
		}
	}

	public function hapus($id)
	{
		try{
            $pendapatsaranhukum = PendapatSaran::findOrFail($id);
			$pendapatsaranhukum->delete();
			return response()->json([
				'swal_pesan' => 'Berhasil menghapus data pendapat saran hukum '.$pendapatsaranhukum->pendapat_saran_laporan_nomor,
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

	public function hapus_proses($id, $status)
	{
		try{
			$pendapatsaranhukum = PendapatSaranProses::where('pendapat_saran_id', $id)->where('pendapat_saran_proses_status', $status)->delete();
			$data = PendapatSaran::findOrFail($id);
			return response()->json([
				'swal_pesan' => 'Berhasil menghapus data proses pendapat saran hukum '.$data->pendapat_saran_laporan_nomor.' dengan status '.$status,
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
