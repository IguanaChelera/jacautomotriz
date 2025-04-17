<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleado';
    protected $primaryKey = 'id_Empleado';
    public $incrementing = true;
    protected $keyType = "int";
    protected $nombre;
    protected $apellidos;
    protected $numeroSeguroSocial;
    protected $experiencia;
    protected $estado;
    protected $fk_id_puesto;
    protected $fillable = ["nombre","apellidos","numeroSeguroSocial","experiencia","estado", "fk_id_puesto"];
    public $timestamps = false;
    
    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'fk_id_puesto', 'id_puesto')
            ->withDefault([
                'nombre_puesto' => 'Sin puesto asignado',
                'sueldo' => 0
            ]);
    }

}
