<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\BantuanHukum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\BantuanHukumProses;
use Illuminate\Support\Facades\Auth;

class PerdataController extends Controller
{
    //
	public function index(Request $req)
	{
        $perdata = BantuanHukum::with(['proses' => function($q) {
			$q->orderBy('created_at', 'desc');
		}])->where(function($query) use ($req){
			$query->where('bantuan_hukum_judul', 'like', '%'.$req->cari.'%')->orWhere('bantuan_hukum_laporan_nomor', 'like', '%'.$req->cari.'%');
		})->where('bantuan_hukum_jenis', 'perdata')->paginate(10);
		$perdata->appends([
			'cari' => $req->cari
			]);
		return view('pages.bantuanhukum.perdata.index', [
            'data' => $perdata,
            'i' => ($req->input('page', 1) - 1) * 10,
            'cari' => $req->cari
        ]);
    }

	public function tambah()
	{
		return view('pages.bantuanhukum.perdata.form',[
            'back' => Str::contains(url()->previous(), ['perdata/tambah', 'perdata/edit', 'perdata/proses'])? '/perdata': url()->previous(),
            'aksi' => 'Tambah'
        ]);
	}

	public function do_tambah(Request $req)
	{
		$req->validate(
			[
                'bantuan_hukum_judul' => 'required',
                'bantuan_hukum_tanggal' => 'required',
                'bantuan_hukum_laporan_nomor' => 'required',
                'bantuan_hukum_proses_deskripsi' => 'required'
			],[
                'bantuan_hukum_judul.required' => 'Judul tidak boleh kosong',
                'bantuan_hukum_tanggal.required' => 'Tanggal tidak boleh kosong',
                'bantuan_hukum_laporan_nomor.required' => 'Nomor tidak boleh kosong',
                'bantuan_hukum_proses_deskripsi.required' => 'Deskripsi tidak boleh kosong'
        	]
		);
		try{
			$perdata = new BantuanHukum();
			$perdata->bantuan_hukum_judul = $req->get('bantuan_hukum_judul');
			$perdata->bantuan_hukum_tanggal = Carbon::parse($req->get('bantuan_hukum_tanggal'))->format('Y-m-d');
			$perdata->bantuan_hukum_laporan_nomor = $req->get('bantuan_hukum_laporan_nomor');
			$perdata->bantuan_hukum_keterangan = $req->get('bantuan_hukum_keterangan');
			$perdata->bantuan_hukum_jenis = 'perdata';
			$perdata->operator = Auth::user()->pengguna_nama;
            $perdata->save();

            $proses = new BantuanHukumProses();
			$proses->bantuan_hukum_id = $perdata->bantuan_hukum_id;
			$proses->bantuan_hukum_proses_status = 'DALAM PROSES';
			$proses->bantuan_hukum_proses_deskripsi = $req->get('bantuan_hukum_proses_deskripsi');
			$proses->bantuan_hukum_proses_tanggal = Carbon::parse($req->get('bantuan_hukum_tanggal'))->format('Y-m-d');
			$proses->operator = Auth::user()->pengguna_nama;
            $proses->save();

			return redirect($req->get('redirect')? $req->get('redirect'): 'perdata')
			->with('swal_pesan', 'Berhasil menambah data pendapat saran hukum '.$req->get('bantuan_hukum_judul'))
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'perdata')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Tambah data')
			->with('swal_tipe', 'error');
		}
	}

	public function edit($id)
	{
		try{
			return view('pages.bantuanhukum.perdata.form', [
                'data' => BantuanHukum::findOrFail($id),
                'back' => Str::contains(url()->previous(), ['perdata/tambah', 'perdata/edit', 'perdata/proses'])? '/perdata': url()->previous(),
                'aksi' => 'Edit'
            ]);
		}catch(\Exception $e){
			return redirect(url()->previous()? url()->previous(): 'perdata')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function do_edit(Request $req)
	{
		$req->validate(
			[
                'bantuan_hukum_judul' => 'required',
                'bantuan_hukum_tanggal' => 'required',
                'bantuan_hukum_laporan_nomor' => 'required'
			],[
                'bantuan_hukum_judul.required' => 'Judul tidak boleh kosong',
                'bantuan_hukum_tanggal.required' => 'Tanggal tidak boleh kosong',
                'bantuan_hukum_laporan_nomor.required' => 'Nomor tidak boleh kosong'
        	]
		);
		try{
			$perdata = BantuanHukum::findOrFail($req->get('bantuan_hukum_id'));
			$perdata->bantuan_hukum_judul = $req->get('bantuan_hukum_judul');
			$perdata->bantuan_hukum_tanggal = Carbon::parse($req->get('bantuan_hukum_tanggal'))->format('Y-m-d');
			$perdata->bantuan_hukum_laporan_nomor = $req->get('bantuan_hukum_laporan_nomor');
			$perdata->bantuan_hukum_keterangan = $req->get('bantuan_hukum_keterangan');
			$perdata->bantuan_hukum_jenis = 'perdata';
			$perdata->operator = Auth::user()->pengguna_nama;
			$perdata->save();
			return redirect($req->get('redirect')? $req->get('redirect'): 'perdata')
			->with('swal_pesan', 'Berhasil mengedit data pendapat saran hukum '.$req->get('bantuan_hukum_judul'))
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'perdata')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function proses($id)
	{
		try{
			return view('pages.bantuanhukum.perdata.proses', [
                'data' => BantuanHukum::with(['proses' => function($q) {
					$q->orderBy('created_at', 'asc');
				}])->findOrFail($id),
                'back' => Str::contains(url()->previous(), ['perdata/tambah', 'perdata/edit', 'perdata/proses'])? '/perdata': url()->previous(),
                'aksi' => 'Proses'
            ]);
		}catch(\Exception $e){
			return redirect(url()->previous()? url()->previous(): 'perdata')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Edit data')
			->with('swal_tipe', 'error');
		}
	}

	public function do_proses(Request $req)
	{
		$req->validate(
			[
                'bantuan_hukum_id' => 'required',
                'bantuan_hukum_proses_status' => 'required',
                'bantuan_hukum_proses_deskripsi' => 'required',
                'bantuan_hukum_proses_tanggal' => 'required'
			],[
                'bantuan_hukum_id.required' => 'No. Laporan tidak boleh kosong',
                'bantuan_hukum_proses_status.required' => 'Status tidak boleh kosong',
                'bantuan_hukum_proses_deskripsi.required' => 'Deskripsi tidak boleh kosong',
                'bantuan_hukum_proses_tanggal.required' => 'Tanggal tidak boleh kosong'
        	]
		);
		try{
            $proses = new BantuanHukumProses();
			$proses->bantuan_hukum_id = $req->bantuan_hukum_id;
			$proses->bantuan_hukum_proses_status = $req->get('bantuan_hukum_proses_status');
			$proses->bantuan_hukum_proses_deskripsi = $req->get('bantuan_hukum_proses_deskripsi');
			$proses->bantuan_hukum_proses_tanggal = Carbon::parse($req->get('bantuan_hukum_tanggal'))->format('Y-m-d');
			$proses->operator = Auth::user()->pengguna_nama;
            $proses->save();
			return redirect($req->get('redirect')? $req->get('redirect'): 'perdata')
			->with('swal_pesan', 'Berhasil menambah data proses pendapat saran hukum '.$req->get('bantuan_hukum_judul'))
			->with('swal_judul', 'Proses data')
			->with('swal_tipe', 'success');
		}catch(\Exception $e){
			return redirect($req->get('redirect')? $req->get('redirect'): 'perdata')
			->with('swal_pesan', $e->getMessage())
			->with('swal_judul', 'Proses data')
			->with('swal_tipe', 'error');
		}
	}

	public function hapus($id)
	{
		try{
            $perdata = BantuanHukum::findOrFail($id);
			$perdata->delete();
			return response()->json([
				'swal_pesan' => 'Berhasil menghapus data pendapat saran hukum '.$perdata->bantuan_hukum_laporan_nomor,
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
			$perdata = BantuanHukumProses::where('bantuan_hukum_id', $id)->where('bantuan_hukum_proses_status', $status)->delete();
			$data = BantuanHukum::findOrFail($id);
			return response()->json([
				'swal_pesan' => 'Berhasil menghapus data proses pendapat saran hukum '.$data->bantuan_hukum_laporan_nomor.' dengan status '.$status,
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
