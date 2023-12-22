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
        Schema::create('usuario_cliente', function (Blueprint $table) {
            $table->unsignedInteger('usuid');
            $table->unsignedInteger('cliid');
            $table->primary(['usuid', 'cliid']);
            $table->foreign('usuid')->references('id')->on('usuario');
            $table->foreign('cliid')->references('id')->on('cliente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_cliente', function (Blueprint $table) {
            $table->dropForeign('usuario_cliente_cliid_foreign');
            $table->dropForeign('usuario_cliente_usuid_foreign');
        });
        Schema::dropIfExists('usuario_cliente');
    }
};
