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
        Schema::create('nps_pesquisa_direcional', function (Blueprint $table) {
            $table->integerIncrements('npdid');
            $table->unsignedInteger('nppid');
            $table->foreign('nppid')->references('id')->on('nps_pesquisa');
            $table->unsignedInteger('sisid')->nullable();
            $table->foreign('sisid')->references('id')->on('sistema');
            $table->unsignedInteger('uniid')->nullable();
            $table->foreign('uniid')->references('id')->on('unidade');
            $table->boolean('npdhabilitado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nps_pesquisa_direcional', function (Blueprint $table) {
            $table->dropForeign('nps_pesquisa_direcional_nppid_foreign');
            $table->dropForeign('nps_pesquisa_direcional_sisid_foreign');
            $table->dropForeign('nps_pesquisa_direcional_uniid_foreign');
        });              
        Schema::dropIfExists('nps_pesquisa_direcional');
    }
};
