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
        Schema::create('nps_pesquisa', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->dateTime('datainicio');
            $table->dateTime('datafim')->nullable();
            $table->string('periodo', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nps_pesquisa');
    }
};
