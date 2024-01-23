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
        Schema::create('nps_resposta', function (Blueprint $table) {
            $table->id('npuid');
            $table->foreign('npuid')->references('id')->on('nps_pesquisa_usuario');
            $table->Integer('catid');
            $table->foreign('catid')->references('id')->on('categoria');
            $table->smallInteger('npsnota');
            $table->string('descricao')->nullable();
            $table->dateTime('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nps_resposta', function (Blueprint $table) {
            $table->dropForeign('nps_resposta_npuid_foreign');
            $table->dropForeign('nps_resposta_catid_foreign');
        });        
        Schema::dropIfExists('nps_resposta');
    }
};
