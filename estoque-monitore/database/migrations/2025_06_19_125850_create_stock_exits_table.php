<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('stock_exits', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Avaria, Empréstimo, etc
            $table->string('document')->nullable(); // Num / Doc
            $table->string('responsible'); // Responsável
            $table->decimal('total_value', 10, 2);
            $table->date('exit_date'); // Data de Saída
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('stock_exits');
    }
};
