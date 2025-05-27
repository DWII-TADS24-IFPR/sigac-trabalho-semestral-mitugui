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
        Schema::create('declaracoes', function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            $table->date('data');

            $table->foreignId('aluno_id')->constrained()->onDelete('cascade');
            $table->foreignId('comprovante_id')->constrained()->onDelete('cascade');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaracoes');
    }
};
