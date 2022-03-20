<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pd_nama');
            $table->string('pd_kode');
            $table->text('pd_deskripsi');
            $table->string('pd_gambar')->nullable();
            $table->integer('pd_stok')->nullable();
            $table->enum('pd_active', ['aktif', 'non-aktif'])->nullable();
            $table->timestamps();

            //fk
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
        Schema::dropIfExists('produks');
    }
}
