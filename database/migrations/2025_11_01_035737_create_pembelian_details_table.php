<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_pembelian_detail', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke header
            $table->foreignId('header_id')->constrained('tbl_pembelian_header')->onDelete('cascade');
            // Foreign Key ke barang
            $table->foreignId('barang_id')->constrained('tbl_barang');
            $table->integer('qty');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_details');
    }
};
