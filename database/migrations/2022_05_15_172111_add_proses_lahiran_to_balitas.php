<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProsesLahiranToBalitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balitas', function (Blueprint $table) {
            $table->enum('proses_lahiran', ['SC', 'Normal'])->after('pb')->nullable();
            $table->string('tempat_lahiran')->after('proses_lahiran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balitas', function (Blueprint $table) {
            $table->dropColumn('proses_lahiran');
            $table->dropColumn('tempat_lahiran');
        });
    }
}
