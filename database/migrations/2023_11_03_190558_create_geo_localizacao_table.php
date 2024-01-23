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
        Schema::create('geo_localizacao', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('nome', 200);
            $table->float('latitude',2 , 10)->number_format(2, 10, ',', '.')->nullable();
            $table->float('longetude',2 , 10)->number_format(2, 10, ',', '.')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geo_localizacao');
    }
};
