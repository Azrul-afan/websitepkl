<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    //
    protected $table = 'inventaris';
    protected $guarded = [];

    //relasi dengan table jenis
    public function jenis(){
        return $this->belongsTo(Jenis::class,'jenis_id','id'); 
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
}
