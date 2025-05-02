<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    public function ventas()
{
    return $this->belongsToMany(Venta::class, 'detalle_venta', 'id_servicio', 'id_venta');
}
    use HasFactory;
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    public $incrementing = true;
    protected $keyType = "int";
    protected $nombreServicio;
    protected $estado;
    protected $costoServicio;
    protected $fillable = ["nombreServicio","estado","costoServicio"];
    public $timestamps = false;

    public function detallesVenta() {
        return $this->hasMany(Detalle_servicio_venta::class, 'fk_id_servicio', 'id_servicio');
    }
}
