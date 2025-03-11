<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_emp_puesto extends Model
{
    use HasFactory;
    protected $table = 'detalle_emp_puesto';
    protected $primaryKey = 'id_empleado_puesto';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fechaInicio;
    protected $fechaFin;
    protected $fk_id_puesto;
    protected $fk_id_empleado;
    protected $fillable = ["fechaInicio","fechaFin","fk_id_puesto","fk_id_empleado"];
    public $timestamps = false;
}
