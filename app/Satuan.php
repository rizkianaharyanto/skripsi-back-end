<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Satuan extends Model
{
    use SoftDeletes;
    protected $fillable = ['st_nama', 'distributor_id'];

    
    public function distributor(){
        return $this->belongsTo(Distributor::class);
    }

    public function produks(){
        return $this->belongsToMany(Produk::class, 'hargas')->withTimestamps()->withPivot('hg_qty', 'hg_nominal');
    }
}
