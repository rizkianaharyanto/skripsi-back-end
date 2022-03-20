<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang_details', function (Blueprint $table) {
            $table->id();
            $table->integer('kdt_qty');
            $table->string('kdt_satuan');
            $table->integer('kdt_harga_used');
            $table->integer('kdt_harga');
            $table->timestamps();

            //fk
            $table->bigInteger('produk_id')->nullable();
            $table->bigInteger('keranjang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keranjang_details');
    }
}
