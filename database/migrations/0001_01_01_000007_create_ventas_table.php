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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('ven_id');
            $table->foreignId('fk_cli_id')->references('cli_id')->on('cliente')->onDelete('restrict')->onUpdate('cascade');
            $table->decimal('ven_tot', 8, 2);
            $table->timestamps();
        });

        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id('det_ven_id');
            $table->foreignId('fk_ven_id')->references('ven_id')->on('ventas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('fk_ped_id')->references('ped_id')->on('pedido')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta');
        Schema::dropIfExists('ventas');
    }
};
