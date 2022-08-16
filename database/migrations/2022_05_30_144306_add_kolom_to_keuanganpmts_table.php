<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKolomToKeuanganpmtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keuanganpmts', function (Blueprint $table) {
            $table->date('tanggal_masuk')->after('uang_masuk');
            $table->date('tanggal_keluar')->after('uang_keluar');
            $table->string('keterangan')->after('tanggal_keluar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keuanganpmts', function (Blueprint $table) {
            $table->dropColumn('tanggal_masuk');
            $table->dropColumn('tanggal_keluar');
            $table->dropColumn('keterangan');
        });
    }
}
