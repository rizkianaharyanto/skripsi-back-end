<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            // $table->string('kr_nama');
            // $table->string('kr_kode');
            // $table->dateTime('kr_tanggal');
            // $table->integer('kr_total_jenis_barang');
            // $table->integer('kr_total_harga');
            // $table->double('kr_diskon', 8, 3)->nullable();
            // $table->integer('kr_biaya_lain')->nullable();
            // $table->integer('kr_diskon_rp')->nullable();
            // $table->enum('kr_active', ['aktif', 'non-aktif'])->nullable();
            $table->timestamps();

            //fk
            $table->bigInteger('toko_id')->nullable();
            $table->bigInteger('sales_id')->nullable();
            $table->bigInteger('distributor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keranjangs');
    }
}
