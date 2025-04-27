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
    protected $fillable = ["fk_id_servicio","precio_unitario","cantidad","subtotal","total","fechaVenta","horaVenta","fk_id_cita"];
    public $timestamps=false;
}