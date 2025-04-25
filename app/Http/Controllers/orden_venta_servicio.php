<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orden_venta_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id_orden_venta');
            $table->unsignedBigInteger('fk_id_servicio');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            
            $table->foreign('fk_id_orden_venta')->references('id_orden_venta')->on('orden_venta')->onDelete('cascade');
            $table->foreign('fk_id_servicio')->references('id_servicio')->on('servicio');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orden_venta_servicio');
    }
};