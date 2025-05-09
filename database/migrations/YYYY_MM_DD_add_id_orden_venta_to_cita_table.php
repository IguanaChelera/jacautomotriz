use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdOrdenVentaToCitaTable extends Migration
{
    public function up()
    {
        Schema::table('cita', function (Blueprint $table) {
            $table->unsignedBigInteger('id_orden_venta')->nullable()->after('fk_id_cliente');
        });
    }

    public function down()
    {
        Schema::table('cita', function (Blueprint $table) {
            $table->dropColumn('id_orden_venta');
        });
    }
}
