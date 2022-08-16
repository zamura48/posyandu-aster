<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddedAtToRiwayatIbuHamilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_ibu_hamils', function (Blueprint $table) {
            $table->enum('pemberian_tablet_tambah_darah', ['Ya', 'Tidak'])->after('hasil_pemeriksaan')->nullable();
            $table->date('tanggal_pemeriksaan')->after('pemberian_tablet_tambah_darah')->nullable();
            $table->string('keterangan')->after('tanggal_pemeriksaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_ibu_hamils', function (Blueprint $table) {
            $table->dropColumn('pemberian_tablet_tambah_darah');
            $table->dropColumn('tanggal_pemeriksaan');
            $table->dropColumn('keterangan');
        });
    }
}
