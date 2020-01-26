<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $table = 'chat';
    protected $primaryKey = 'chat_id';
    protected $fillable = ['chat_dari', 'chat_kepada', 'chat_pesan', 'terbaca'];
}
