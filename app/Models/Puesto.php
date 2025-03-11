<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    protected $table = 'puesto';
    protected $primaryKey = 'id_puesto';
    public $incrementing = true;
    protected $keyType = "int";
    protected $nombre_puesto;
    protected $sueldo;
    protected $fillable = ["nombre_puesto","sueldo"];
    public $timestamps = false;
}
