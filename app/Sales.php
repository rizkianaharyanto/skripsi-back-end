<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sales extends Model
{
    use SoftDeletes;
    protected $table = 'saless';
    protected $primaryKey = 'id';
    protected $fillable = ['sl_kode', 'sl_nama', 'sl_alamat', 'sl_telp', 'sl_email', 'sl_gambar', 'sl_active', 'distributor_id'];

    public function distributor(){
        return $this->belongsTo(Distributor::class);
    }

    public function pesanans(){
        return $this->hasMany(Pesanan::class);
    }

    public function keranjangs(){
        return $this->hasMany(Keranjang::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
