<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrdenVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_orden_venta';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fk_id_orden_venta;
    protected $fk_id_servicio;
    protected $cantidad;
    protected $precio_unitario;
    protected $subtotal;
    protected $created_at;
    protected $updated_at;
    protected $fillable=["fk_id_orden_venta","fk_id_servicio","cantidad","precio_unitario","subtotal"];
    public $timestamps = true;
}