<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference')->nullable(); // Referência
            $table->text('description')->nullable();
            $table->string('unit'); // Unidade (UN, KG, CX)
            $table->decimal('sale_price', 10, 2)->default(0); // Preço Venda
            $table->integer('stock_quantity')->default(0); // Estoque
            $table->integer('minimum_stock_quantity')->default(0); // Estoque Mínimo
            $table->string('photo_path', 2048)->nullable();

            // Chaves Estrangeiras (As Conexões)
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
};
