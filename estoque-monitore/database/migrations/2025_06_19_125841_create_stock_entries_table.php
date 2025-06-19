<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('stock_entries', function (Blueprint $table) {
            $table->id();
            $table->string('note_number')->nullable(); // Num / Nota
            $table->decimal('total_value', 10, 2); // Valor Total
            $table->date('emission_date'); // Data de Emissão da Nota
            $table->date('entry_date'); // Data de Entrada no Estoque
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('user_id')->constrained('users'); // Quem registrou
            $table->timestamps(); // Data de Cadastro
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('stock_entries');
    }
};
