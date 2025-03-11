<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente'; 
    protected $primaryKey = 'id_cliente';
    public $incrementing = true;
    protected $keyType = "int";
    protected $nombre;
    protected $telefono;
    protected $correo;
    protected $direccion;
    protected $fillable=["nombre","telefono","correo","direccion"];
    public $timestamps = false;
}
