<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function servicios()
{
    return $this->belongsToMany(Servicio::class, 'detalle_venta', 'id_venta', 'id_servicio');
}
    use HasFactory;
    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fillable = ["total","fechaVenta","horaVenta","fk_id_cita"];
    public $timestamps=false;

    public function cita()
{
    return $this->belongsTo(Cita::class, 'fk_id_cita', 'id_Cita');
}
public function detallesServicio()
 {
    return $this->hasMany(Detalle_servicio_venta::class, 'fk_id_venta', 'id_venta');
}

public function ordenVenta()
{
    return $this->hasOneThrough(OrdenVenta::class, Cita::class, 'id_Cita', 'id_orden_venta', 'fk_id_cita', 'id_orden_venta');
}
}
