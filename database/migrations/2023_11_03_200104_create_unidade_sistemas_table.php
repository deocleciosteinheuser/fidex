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
        Schema::create('unidade_sistema', function (Blueprint $table) {
            $table->unsignedInteger('uniid');
            $table->foreign('uniid')->references('id')->on('unidade');
            $table->unsignedInteger('sisid');
            $table->foreign('sisid')->references('id')->on('sistema');
            $table->primary(['uniid','sisid']);
            $table->unsignedInteger('serid')->nullable();
            $table->foreign('serid')->references('id')->on('servidor');
            $table->unsignedInteger('usuid')->nullable();
            $table->foreign('usuid')->references('id')->on('usuario');
            $table->float('mrr', 10, 5);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unidade_sistema', function (Blueprint $table) {
            $table->dropForeign('unidade_sistema_uniid_foreign');
            $table->dropForeign('unidade_sistema_sisid_foreign');
            $table->dropForeign('unidade_sistema_serid_foreign');
            $table->dropForeign('unidade_sistema_usuid_foreign');
        });

        Schema::dropIfExists('unidade_sistema');
    }
};
