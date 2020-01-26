<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendapatSaranProses extends Model
{
    //
    protected $table = 'pendapat_saran_proses';
    protected $primaryKey = 'pendapat_saran_proses_id';


    public function master(){
        return $this->belongsTo('App\PendapatSaran', 'pendapat_saran_id', 'pendapat_saran_id');
	}
}
