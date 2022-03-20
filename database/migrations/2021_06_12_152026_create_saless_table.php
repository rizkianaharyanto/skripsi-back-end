<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saless', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sl_nama', 100);
            $table->string('sl_kode');
            $table->string('sl_alamat')->nullable();
            $table->string('sl_telp');
            $table->string('sl_email');
            $table->string('sl_gambar')->nullable();
            $table->enum('sl_active', ['aktif', 'non-aktif'])->nullable();
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
        Schema::dropIfExists('saless');
    }
}
