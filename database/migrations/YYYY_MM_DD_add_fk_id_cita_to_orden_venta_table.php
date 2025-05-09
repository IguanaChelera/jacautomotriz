use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkIdCitaToOrdenVentaTable extends Migration
{
    public function up()
    {
        Schema::table('orden_venta', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_id_cita')->nullable()->after('id_orden_venta');
            $table->foreign('fk_id_cita')->references('id_Cita')->on('cita')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('orden_venta', function (Blueprint $table) {
            $table->dropForeign(['fk_id_cita']);
            $table->dropColumn('fk_id_cita');
        });
    }
}
