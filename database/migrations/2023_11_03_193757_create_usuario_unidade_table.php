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
        Schema::create('usuario_unidade', function (Blueprint $table) {
            $table->unsignedInteger('usuid');
            $table->foreign('usuid')->references('id')->on('users');
            $table->unsignedInteger('uniid');
            $table->foreign('uniid')->references('id')->on('unidade');
            $table->primary(['usuid', 'uniid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_unidade', function (Blueprint $table) {
            $table->dropForeign('usuario_unidade_usuid_foreign');
            $table->dropForeign('usuario_unidade_uniid_foreign');
        });

        Schema::dropIfExists('usuario_unidade');
    }
};
