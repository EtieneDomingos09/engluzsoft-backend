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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tipo_imovel');
            $table->string('tipo_transacao'); // venda ou aluguel
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->integer('quartos')->default(0);
            $table->integer('banheiros')->default(0);
            $table->float('area_util')->nullable();
            $table->float('area_total')->nullable();
            $table->string('endereco');
            $table->string('provincia');
            $table->string('municipio');
            $table->decimal('preco', 12, 2);
            $table->string('telefone_contato');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
