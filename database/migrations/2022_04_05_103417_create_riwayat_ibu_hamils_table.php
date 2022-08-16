<?php

use App\Models\IbuHamil;
use App\Models\Kader;
use App\Models\Ortu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatIbuHamilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_ibu_hamils', function (Blueprint $table) {
            $table->id();
            $table->integer('umur_kehamilan');
            $table->string('hasil_pemeriksaan');
            $table->foreignIdFor(Kader::class);
            $table->foreignIdFor(Ortu::class);
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
        Schema::dropIfExists('riwayat_ibu_hamils');
    }
}
