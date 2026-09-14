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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('item_code')->unique(); // Kode unik barang, misal: BRG-001
        $table->string('name');                // Nama barang
        $table->string('category');            // Kategori (Elektronik, Perkakas, dll)
        $table->integer('quantity');           // Jumlah stok di gudang
        $table->integer('minimum_stock');      // Batas minimum stok
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
