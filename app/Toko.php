<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $fillable = [
        'tk_nama',
        'tk_alamat',
        'tk_pemilik',
        'tk_telp',
        'tk_email',
        'tk_gambar',
        'tk_active', 
        'alasan_tolak'
    ];

    public function pesanans(){
        return $this->hasMany(Pesanan::class);
    }

    public function distributors(){
        return $this->belongsToMany(Distributor::class, 'mitras')->withTimestamps();
    }

    public function pengajuans(){
        return $this->belongsToMany(Distributor::class, 'pengajuans')->withTimestamps()->withPivot('alasan_tolak');
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
