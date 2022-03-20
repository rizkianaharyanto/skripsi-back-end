<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;
    protected $fillable = ['pd_kode', 'pd_nama', 'pd_deskripsi', 'pd_stok', 'pd_gambar', 'pd_active', 'distributor_id'];

    public function distributor(){
        return $this->belongsTo(Distributor::class);
    }
    
    public function satuans(){
        return $this->belongsToMany(Satuan::class, 'hargas')->withTimestamps()->withPivot('hg_qty', 'hg_nominal');
    }
    
    public function pesanans(){
        return $this->belongsToMany(Pesanan::class, 'pesanan_details')->withTimestamps()->withPivot('dt_qty', 'dt_satuan', 'dt_harga', 'dt_status');
    }
    
    public function keranjangs(){
        return $this->belongsToMany(Keranjang::class, 'keranjang_details')->withTimestamps()->withPivot('kdt_qty', 'kdt_satuan', 'kdt_harga');
    }
}
