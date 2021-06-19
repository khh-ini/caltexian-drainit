<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitikBanjirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titik_banjirs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_admin');
            $table->geometry('geometry');
            $table->text('nama_jalan');
            $table->text('kondisi_kerusakan');
            $table->text('keterangan')->nullable();
            $table->text('status');
            $table->string('foto');
            $table->timestamps();
        });
        Schema::table('titik_banjirs', function($table){
            $table->foreign('id_admin')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titik_banjirs');
    }
}
