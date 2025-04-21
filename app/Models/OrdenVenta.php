<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenVenta extends Model
{
    use HasFactory;

    protected $table = 'ordenes_venta';
    protected $primaryKey = 'id_orden';
    protected $fillable = [
        'fecha',
        'total',
        'fk_id_cita',
        'fk_id_cliente',
        'estado'
    ];
    public $timestamps = false;

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'fk_id_cita');
    }

    public function items()
    {
        return $this->hasMany(OrdenVentaItem::class, 'fk_id_orden');
    }
}