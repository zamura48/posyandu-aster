<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganToPraUpdateBalitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pra_update_balitas', function (Blueprint $table) {
            $table->string('keterangan')->after('tempat_lahiran')->nullable();
            $table->foreignIdFor(User::class)->after('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pra_update_balitas', function (Blueprint $table) {
            $table->dropColumn('keterangan');
            $table->dropColumn(User::class);
        });
    }
}
