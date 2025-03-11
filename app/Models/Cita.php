<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'cita';
    protected $primaryKey = 'id_Cita';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fechaCita;
    protected $horaCita;
    protected $marcaVehiculo;
    protected $modeloVehiculo;
    protected $fk_id_cliente;
    protected $fillable = ["fechaCita","horaCita","marcaVehiculo","modeloVehiculo","fk_id_cliente"];
    public $timestamps = false;
}
