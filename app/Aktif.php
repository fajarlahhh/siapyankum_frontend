<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktif extends Model
{
    //
    protected $table = 'aktif';
    protected $primaryKey = 'pengguna_id';

    public function pengguna(){
        return $this->hasOne('App\Pengguna', 'pengguna_id', 'pengguna_id');
	}
}
