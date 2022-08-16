<?php

use App\Models\IbuKB;
use App\Models\Kader;
use App\Models\Ortu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatIbuKbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_ibu_kbs', function (Blueprint $table) {
            $table->id();
            $table->string('riwayat_kb');
            $table->string('suntik_awal');
            $table->string('suntik_akhir');
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
        Schema::dropIfExists('riwayat_ibu_kbs');
    }
}
