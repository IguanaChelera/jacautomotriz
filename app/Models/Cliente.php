<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente'; 
    protected $primaryKey = 'id_cliente';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fillable = ["nombre", "telefono", "correo", "direccion", "activo"];
    public $timestamps = false;


    public function citas()
    {
        return $this->hasMany(Cita::class, 'fk_id_cliente', 'id_cliente');
    }

        public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->boolean('activo')->default(1); // 1 significa activo
        });
    }

    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->dropColumn('activo');
        });
    }
}
