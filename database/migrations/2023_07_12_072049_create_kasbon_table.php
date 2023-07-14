<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasbon', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('jenis_pemasukan_pengeluaran_kas_id')->constrained('jenis_pemasukan_pengeluaran_kas')->onDelete("CASCADE")->onUpdate('CASCADE');
            $table->string('keterangan');
            $table->integer('uang_kasbon');
            $table->date('tanggal_kasbon');
            $table->string('nama');
            $table->string('no_telepon');
            $table->string('status');
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
        Schema::dropIfExists('kasbon');
    }
};
