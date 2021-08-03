<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('nominal')->default(0);
            $table->bigInteger('dp')->default(0);
            $table->bigInteger('sisa')->default(0);
            $table->string('waktu_sewa')->nullable();
            $table->string('tipe_transaksi');
            $table->string('no_kontrak')->nullable();
            $table->integer('status_pembayaran');
            $table->string('keterangan_pembayaran')->nullable();
            $table->integer('status_barang')->default(1);
            $table->string('teknisiloading_id');
            $table->string('teknisibongkar_id')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
