<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendapatSaran extends Model
{
    //
    protected $table = 'pendapat_saran';
    protected $primaryKey = 'pendapat_saran_id';


    public function proses(){
        return $this->hasMany('App\PendapatSaranProses', 'pendapat_saran_id', 'pendapat_saran_id');
	}
}
