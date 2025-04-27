<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_servicio_venta extends Model
{
    use HasFactory;
    protected $table = 'detalle_servicio_venta';
    protected $primaryKey = 'id_servicio_venta';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fk_id_servicio;
    protected $fk_id_venta;
    protected $fk_costoServicio;
    protected $cantidad;
    protected $subtotal;
    protected $fillable = ["fk_id_servicio","fk_id_venta","fk_costoServicio","cantidad","subtotal"];
    public $timestamps = false;
}
