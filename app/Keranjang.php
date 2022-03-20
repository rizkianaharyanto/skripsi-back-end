<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = [
        // 'kr_nama',
        // 'kr_kode',
        // 'kr_tanggal',
        // 'kr_total_jenis_barang',
        // 'kr_total_harga',
        // 'kr_diskon',
        // 'kr_biaya_lain',
        // 'kr_diskon_rp',
        // 'kr_active',
        'toko_id',
        'sales_id',
        'distributor_id'
    ];

    public function toko(){
        return $this->belongsTo(Toko::class);
    }

    public function sales(){
        return $this->belongsTo(Sales::class);
    }

    public function distributor(){
        return $this->belongsTo(Distributor::class);
    }
    
    public function produks(){
        return $this->belongsToMany(Produk::class, 'keranjang_details')->withTimestamps()->withPivot('kdt_qty', 'kdt_satuan', 'kdt_harga', 'kdt_harga_used');
    }
}
