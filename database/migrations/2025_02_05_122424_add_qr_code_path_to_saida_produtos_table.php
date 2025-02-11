<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrCodePathToSaidaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saida_produtos', function (Blueprint $table) {
            $table->string('qr_code_path')->nullable();  // Adiciona a coluna 'qr_code_path' do tipo string
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saida_produtos', function (Blueprint $table) {
            $table->dropColumn('qr_code_path');  // Remove a coluna 'qr_code_path' caso a migração seja revertida
        });
    }
}
