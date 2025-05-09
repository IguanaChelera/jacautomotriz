<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    
    protected $table = 'cita';
    protected $primaryKey = 'id_Cita';
    protected $fillable = [
        "fechaCita",
        "horaCita",
        "marcaVehiculo",
        "modeloVehiculo",
        "fk_id_cliente",
        "fk_id_orden_venta" // Correctamente configurada
    ];
    public $timestamps = false;
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'fk_id_cliente');
    }

    public function ordenVenta()
    {
        return $this->hasOne(OrdenVenta::class,'fk_id_orden_venta');
    }
}