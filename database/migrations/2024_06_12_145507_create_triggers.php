<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER producto_AFTER_INSERT AFTER INSERT ON producto
            FOR EACH ROW
            BEGIN
              insert into inventario (fk_pro_id, inv_stock, fk_est_inv_id) values (New.pro_id, 1, 1);
            END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS producto_AFTER_INSERT');
    }
};
