<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbuBalitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibu_balitas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->nullable();
            $table->string('nama_ibu', 50);
            $table->string('pekerjaan_ibu', 25)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('nomor_telepon', 15);
            $table->string('nama_ayah', 50);
            $table->string('pekerjaan_ayah', 25)->nullable();
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ibu_balitas');
    }
}
