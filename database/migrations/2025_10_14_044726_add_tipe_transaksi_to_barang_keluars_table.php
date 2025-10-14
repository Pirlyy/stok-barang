<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('barang_keluars', function (Blueprint $table) {
        $table->enum('tipe_transaksi', ['keluar', 'retur'])->default('keluar')->after('jumlah');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_keluars', function (Blueprint $table) {
            //
        });
    }
};
