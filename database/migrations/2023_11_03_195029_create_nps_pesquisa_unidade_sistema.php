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
        Schema::create('nps_pesquisa_unidade_sistema', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nppid');
            $table->foreign('nppid')->references('id')->on('nps_pesquisa');
            $table->unsignedInteger('sisid');
            $table->foreign('sisid')->references('id')->on('sistema');
            $table->unsignedInteger('uniid');
            $table->foreign('uniid')->references('id')->on('unidade');
            $table->unsignedInteger('matid');
            $table->foreign('matid')->references('id')->on('modelo_atendimento');
            $table->unsignedInteger('serid');
            $table->foreign('serid')->references('id')->on('servidor');
            $table->unsignedInteger('geoid');
            $table->foreign('geoid')->references('id')->on('geo_localizacao');
            $table->float('mrr', 10, 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nps_pesquisa_unidade_sistema', function (Blueprint $table) {
            $table->dropForeign('nps_pesquisa_unidade_sistema_nppid_foreign');
            $table->dropForeign('nps_pesquisa_unidade_sistema_sisid_foreign');
            $table->dropForeign('nps_pesquisa_unidade_sistema_uniid_foreign');
            $table->dropForeign('nps_pesquisa_unidade_sistema_matid_foreign');
            $table->dropForeign('nps_pesquisa_unidade_sistema_serid_foreign');
            $table->dropForeign('nps_pesquisa_unidade_sistema_geoid_foreign');
        });        
        Schema::dropIfExists('nps_pesquisa_unidade_sistema');
    }
};
