<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BantuanHukum extends Model
{
    //
    protected $table = 'bantuan_hukum';
    protected $primaryKey = 'bantuan_hukum_id';


    public function proses(){
        return $this->hasMany('App\BantuanHukumProses', 'bantuan_hukum_id', 'bantuan_hukum_id');
	}
}
