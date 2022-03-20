<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dt_qty');
            $table->string('dt_satuan');
            $table->integer('dt_harga_used');
            $table->integer('dt_harga');
            $table->enum('dt_status', ['tersedia','stok kurang'])->nullable();
            $table->timestamps();

            //fk
            $table->bigInteger('produk_id')->nullable();
            $table->bigInteger('pesanan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_details');
    }
}
