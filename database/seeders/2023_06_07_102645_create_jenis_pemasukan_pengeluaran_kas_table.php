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
        Schema::create('jenis_pemasukan_pengeluaran_kas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('jenis', ['pengeluaran', 'pemasukan']);
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
        Schema::dropIfExists('jenis_pemasukan_pengeluaran_kas');
    }
};
