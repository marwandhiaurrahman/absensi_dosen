<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('hari');
            $table->string('jam');
            $table->foreignId('matkul_id')->unsigned()->references('id')->on('matkuls')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ruangan_id')->unsigned()->references('id')->on('ruangans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kelas_id')->unsigned()->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('jadwals');
    }
}
