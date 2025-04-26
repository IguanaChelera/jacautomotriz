<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenVenta extends Model
{
    use HasFactory;
    protected $table = 'orden_venta';
    protected $primaryKey = 'id_orden_venta';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fecha;
    protected $total;
    protected $fk_id_cita;
    protected $fk_id_empleado;
    protected $created_at;
    protected $updated_at;
    protected $fillable=["fecha","total","fk_id_cita","fk_id_empleado"];
    public $timestamps = true;
}
