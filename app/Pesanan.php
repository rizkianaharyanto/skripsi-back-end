<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'ps_nama',
        'ps_kode',
        'ps_tanggal',
        'ps_total_jenis_barang',
        'ps_total_harga',
        'ps_diskon',
        'ps_biaya_lain',
        'ps_diskon_rp',
        'ps_status',
        'ps_active',
        'toko_id',
        'distributor_id',
        'sales_id',
        'alasan_tolak'
    ];

    public function sales(){
        return $this->belongsTo(Sales::class);
    }

    public function toko(){
        return $this->belongsTo(Toko::class);
    }

    public function distributor(){
        return $this->belongsTo(Distributor::class);
    }
    
    public function produks(){
        return $this->belongsToMany(Produk::class, 'pesanan_details')->withTimestamps()->withPivot('dt_qty', 'dt_satuan', 'dt_harga', 'dt_status', 'dt_harga_used');
    }
}
