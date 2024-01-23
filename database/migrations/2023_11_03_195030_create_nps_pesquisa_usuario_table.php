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
        Schema::create('nps_pesquisa_usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('npuid');
            $table->foreign('npuid')->references('id')->on('nps_pesquisa_unidade_sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::hasTable('nps_pesquisa_usuario') && Schema::table('nps_pesquisa_usuario', function (Blueprint $table) {
            $table && $table->dropForeign('nps_pesquisa_usuario_npuid_foreign');
        });              
        Schema::dropIfExists('nps_pesquisa_usuario');
    }
};
