<?php

use App\Models\Balita;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenimbanganDanVitaminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penimbangan_dan_vitamin', function (Blueprint $table) {
            $table->id();
            $table->enum('vitamin_a', ['Merah', 'Biru'])->nullable();
            $table->integer('bb');
            $table->integer('tb');
            $table->enum('aksi_eksklusif', ['Ya', 'Tidak'])->nullable();
            $table->enum('inisiatif_menyusui_dini', ['Ya', 'Tidak'])->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal_input');
            $table->foreignIdFor(Balita::class);
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
        Schema::dropIfExists('penimbangan_dan_vitamin');
    }
}
