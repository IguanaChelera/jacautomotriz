<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenVenta extends Model
{
    use HasFactory;
    
    protected $table = 'orden_venta';
    protected $primaryKey = 'id_orden_venta';
    protected $fillable = [
        "fecha",
        "total",
        "fk_id_cita",
        "fk_id_empleado"
    ];
    public $timestamps = false;
    
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'fk_id_cita');
    }
    
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'fk_id_empleado');
    }
    
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'orden_venta_servicio', 'fk_id_orden_venta', 'fk_id_servicio')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal');
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'fk_id_cliente');
    }
}