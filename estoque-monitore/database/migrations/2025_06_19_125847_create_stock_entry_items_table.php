<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('stock_entry_items', function (Blueprint $table) {
            $table->id();
            // Conecta este item à "capa" da nota. Se a nota for apagada, os itens vão junto.
            $table->foreignId('stock_entry_id')->constrained('stock_entries')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->decimal('purchase_price', 10, 2); // Preço de compra do item NESSA entrada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('stock_entry_items');
    }
};
