<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenVentaItem extends Model
{
    use HasFactory;

    protected $table = 'ordenes_venta_items';
    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'fk_id_orden',
        'fk_id_servicio'
    ];
    public $timestamps = false;


    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'fk_id_servicio');
    }
}