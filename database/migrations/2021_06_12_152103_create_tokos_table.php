<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tk_nama', 100);
            $table->string('tk_alamat');
            $table->string('tk_pemilik');
            $table->string('tk_telp');
            $table->string('tk_email');
            $table->string('tk_gambar')->nullable();
            $table->enum('tk_active', ['aktif', 'non-aktif', 'tolak'])->nullable();
            $table->string('alasan_tolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokos');
    }
}
