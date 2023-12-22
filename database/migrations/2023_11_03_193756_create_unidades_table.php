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
        Schema::create('unidade', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('nome', 200);
            $table->unsignedInteger('geoid')->nullable();
            $table->foreign('geoid')->references('id')->on('geo_localizacao');
            $table->unsignedInteger('cliid');
            $table->foreign('cliid')->references('id')->on('cliente');
            $table->unsignedInteger('matid')->nullable();
            $table->foreign('matid')->references('id')->on('modelo_atendimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidade');
    }
};
