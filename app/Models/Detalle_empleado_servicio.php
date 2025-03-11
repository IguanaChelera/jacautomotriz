<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_empleado_servicio extends Model
{
    use HasFactory;
    protected $table = 'detalle_empleado_servicio';
    protected $primaryKey = 'id_empleado_servicio';
    public $incrementing = true;
    protected $keyType = "int";
    protected $servicio_realizado;
    protected $fk_id_empleado;
    protected $fk_id_servicio;
    protected $fillable = ["servicio_realizado","fk_id_empleado","fk_id_servicio"];
    public $timestamps = false;
}
