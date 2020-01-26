<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    //
    protected $table = 'peraturan';
    protected $primaryKey = 'peraturan_id';
    

    public function jenis(){
        return $this->belongsTo('App\JenisPeraturan', 'peraturan_jenis_id', 'peraturan_jenis_id');
	}
}
