<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->string('pertemuan');
            $table->date('tanggal');
            $table->string('metode');
            $table->string('pembahasan');
            $table->time('masuk');
            $table->time('keluar')->nullable();
            $table->double('jarak');
            $table->foreignId('jadwal_id')->unsigned()->references('id')->on('jadwals')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('absensis');
    }
}
