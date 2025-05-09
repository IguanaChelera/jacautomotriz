<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cita', function (Blueprint $table) {
            $table->unsignedBigInteger('id_orden_venta')->nullable()->after('fk_id_cliente');
            $table->foreign('id_orden_venta')->references('id_orden_venta')->on('orden_venta')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('cita', function (Blueprint $table) {
            $table->dropForeign(['id_orden_venta']);
            $table->dropColumn('id_orden_venta');
        });
    }
};
