<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // database/migrations/xxxx_xx_xx_create_barang_masuks_table.php
Schema::create('barang_masuks', function (Blueprint $table) {
    $table->id();
    $table->string('nama_barang');
    $table->integer('jumlah');
    $table->string('supplier')->nullable();
    $table->string('satuan')->nullable();
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
};
