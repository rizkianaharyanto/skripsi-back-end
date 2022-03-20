<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ps_nama');
            $table->string('ps_kode');
            $table->dateTime('ps_tanggal');
            $table->integer('ps_total_jenis_barang');
            $table->integer('ps_total_harga');
            $table->double('ps_diskon', 8, 3)->nullable();
            $table->integer('ps_biaya_lain')->nullable();
            $table->integer('ps_diskon_rp')->nullable();
            $table->enum('ps_status', ['baru','diterima sales', 'dalam pengiriman', 'diterima pembeli', 'ditolak', 'selesai'])->nullable();
            $table->string('alasan_tolak')->nullable();
            $table->enum('ps_active', ['aktif', 'non-aktif'])->nullable();
            $table->timestamps();

            //fk
            $table->bigInteger('toko_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
