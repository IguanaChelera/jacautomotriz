<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $incrementing = true;
    protected $keyType = "int";
    protected $total;
    protected $fechaVenta;
    protected $horaVenta;
    protected $fk_id_cita;
    protected $fillable = ["total","fechaVenta","horaVenta","fk_id_cita"];
    public $timestamps = false;
}
