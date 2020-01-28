<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Aktif;
use App\Pengguna;
use App\Events\KirimPesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pusher\Laravel\Facades\Pusher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class KonsultasihukumController extends Controller
{
    public function index()
    {
        $user = DB::select("select pengguna.pengguna_id, pengguna_nama, count(terbaca) as unread, aktif.created_at
        from (aktif left join pengguna on aktif.pengguna_id = md5(pengguna.pengguna_id)) LEFT JOIN chat ON pengguna.pengguna_id = chat.chat_dari and terbaca = 0 and chat.chat_kepada = '" . Auth::id() . "'
        where pengguna_admin = 0
        group by pengguna_id, pengguna_nama, aktif.created_at order by aktif.created_at asc");
        return view('pages.konsultasihukum.index', ['data' => $user]);
    }

    public function laporan()
    {
        return view('pages.daftarkonsultasihukum.index');
    }

    public function cetak(Request $req)
    {
        $data = DB::select("select a.*, b.pengguna_id pengguna_id, b.pengguna_nama pengguna_nama from chat a left join pengguna b on a.chat_dari=md5(b.pengguna_id) where date(a.created_at)='".date('Y-m-d', strtotime($req->tanggal))."'");
        return view('pages.daftarkonsultasihukum.cetak', ['data' => $data, 'tanggal' => $req->tanggal]);
    }

    public function getAktif(Request $req){
        return DB::select("select pengguna.pengguna_id, pengguna_nama, count(terbaca) as unread from (aktif left join pengguna on aktif.pengguna_id = md5(pengguna.pengguna_id)) LEFT JOIN chat ON pengguna.pengguna_id = chat.chat_dari where aktif.pengguna_id = '" . $req->id . "' group by pengguna_id, pengguna_nama");
    }

    public function member(){
        if(!Auth::check())
            return redirect('/frontend/konsultasihukum/login');

        $penerima = md5(Auth::id());
        $pengirim = md5('admin');
        Chat::where(['chat_dari' => $pengirim, 'chat_kepada' => $penerima])->update(['terbaca' => 1]);

        $messages = Chat::where(function ($query) use ($pengirim, $penerima) {
            $query->where('chat_dari', $pengirim)->where('chat_kepada', $penerima);
        })->oRwhere(function ($query) use ($pengirim, $penerima) {
            $query->where('chat_dari', $penerima)->where('chat_kepada', $pengirim);
        })->get();

        return view('frontend.pages.konsultasihukum.index', ['messages' => $messages]);
    }

    public function ambilUser($penerima, $pengirim)
    {
        Chat::where(['chat_dari' => $pengirim, 'chat_kepada' => $penerima])->update(['terbaca' => 1]);

        $messages = Chat::where(function ($query) use ($pengirim, $penerima) {
            $query->where('chat_dari', $pengirim)->where('chat_kepada', $penerima);
        })->oRwhere(function ($query) use ($pengirim, $penerima) {
            $query->where('chat_dari', $penerima)->where('chat_kepada', $pengirim);
        })->get();

        return view('pages.konsultasihukum.pesan', ['messages' => $messages]);
    }

    public function hapusAktif($id)
    {
        Aktif::where('pengguna_id', $id)->delete();
    }

    public function terimaPesan($penerima, $pengirim, $aktif = '')
    {
        Chat::where(['chat_dari' => $pengirim, 'chat_kepada' => $penerima])->update(['terbaca' => 1]);

        $messages = Chat::where(function ($query) use ($pengirim, $penerima) {
            $query->where('chat_dari', $pengirim)->where('chat_kepada', $penerima);
        })->oRwhere(function ($query) use ($pengirim, $penerima) {
            $query->where('chat_dari', $penerima)->where('chat_kepada', $pengirim);
        })->get();

        $dari = Pengguna::whereRaw("md5(pengguna_ID) = '".$penerima."' and pengguna_admin=0")->first();
        return view('pages.konsultasihukum.pesan', ['messages' => $messages, 'penerima' => $dari?$dari->pengguna_nama.' ('.$dari->pengguna_id.')' : '']);
    }

    public function kirimPesan(Request $request)
    {
        $from = md5(Auth::id());
        $to = $request->receiver_id;
        $message = $request->message;

        if($request->aktif == 1){
            if(Aktif::where('pengguna_id', $from)->count() == 0 )
            {
                $data = new Aktif();
                $data->pengguna_id = $from;
                $data->save();
            }
        }else{
            Aktif::where('pengguna_id', $to)->delete();
        }

        $data = new Chat();
        $data->chat_dari = $from;
        $data->chat_kepada = $to;
        $data->chat_pesan = $message;
        $data->terbaca = 0;
        $data->save();

        $data = ['from' => $from, 'to' => $to];
        Pusher::trigger('my-channel', 'my-event', $data);

        // $options = array(
        //     'cluster' => 'ap1',
        //     'forceTLS' => true,
        //     'encrypted' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        // $pusher->trigger('my-channel', 'my-event', $data);
    }
}
