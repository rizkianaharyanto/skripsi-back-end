<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ds_nama', 100);
            $table->string('ds_kode');
            $table->string('ds_alamat');
            $table->string('ds_pemilik')->nullable();
            $table->text('ds_deskripsi')->nullable();
            $table->string('ds_telp');
            $table->string('ds_email');
            $table->string('ds_gambar')->nullable();
            $table->enum('ds_active', ['aktif', 'non-aktif', 'tolak'])->nullable();
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
        Schema::dropIfExists('distributors');
    }
}
