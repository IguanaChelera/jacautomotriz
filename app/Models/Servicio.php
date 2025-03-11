<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
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
}
