<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::create('produto_saida_produto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained()->onDelete('cascade');
            $table->foreignId('saida_produto_id')->constrained()->onDelete('cascade');
            $table->integer('quantidade'); // Se você precisar armazenar a quantidade no relacionamento
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('produto_saida_produto');
    }

};
