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
        Schema::create('nps_feedback', function (Blueprint $table) {
            $table->id('npuid');
            $table->foreign('npuid')->references('id')->on('nps_pesquisa_usuario');
            $table->string('descricao');            
            $table->boolean('util');
            $table->boolean('visto');
            $table->integer('usuid');
            $table->foreign('usuid')->references('id')->on('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nps_feedback', function (Blueprint $table) {
            $table->dropForeign('nps_feedback_npuid_foreign');
            $table->dropForeign('nps_feedback_usuid_foreign');
        });              
        Schema::dropIfExists('nps_feedback');
    }
};
