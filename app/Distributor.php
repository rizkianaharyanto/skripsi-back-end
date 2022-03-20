<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $fillable = ['ds_kode', 'ds_nama', 'ds_alamat', 'ds_telp', 'ds_email', 'ds_pemilik', 'ds_deskripsi', 'ds_gambar', 'ds_active', 'alasan_tolak'];

    public function saless(){
        return $this->hasMany(Sales::class);
    }
    
    public function produks(){
        return $this->hasMany(Produk::class);
    }
    
    public function satuans(){
        return $this->hasMany(Satuan::class);
    }
    
    public function pesanans(){
        return $this->hasMany(Pesanan::class);
    }
    
    public function tokos(){
        return $this->belongsToMany(Toko::class, 'mitras')->withTimestamps();
    }
    
    public function pengajuans(){
        return $this->belongsToMany(Toko::class, 'pengajuans')->withTimestamps()->withPivot('alasan_tolak');
    }
    
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
