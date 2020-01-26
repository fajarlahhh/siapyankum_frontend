<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BantuanHukumProses extends Model
{
    //
    protected $table = 'bantuan_hukum_proses';
    protected $primaryKey = 'bantuan_hukum_proses_id';


    public function master(){
        return $this->belongsTo('App\BantuanHukum', 'bantuan_hukum_id', 'bantuan_hukum_id');
	}
}
