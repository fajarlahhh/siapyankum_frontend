<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeraturanJenis extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'peraturan_jenis';
    protected $primaryKey = 'peraturan_jenis_id';
    

    public function peraturan(){
        return $this->hasMany('App\Peraturan', 'peraturan_jenis_id', 'peraturan_jenis_id');
	}
}
