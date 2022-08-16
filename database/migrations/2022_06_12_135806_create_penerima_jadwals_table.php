<?php

use App\Models\JadwalKegiatan;
use App\Models\Ortu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerima_jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ortu::class);
            $table->foreignIdFor(JadwalKegiatan::class);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('penerima_jadwals');
    }
}
