<?php

use App\Models\Balita;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimbangdanVitaminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timbangdan_vitamins', function (Blueprint $table) {
            $table->id();
            $table->enum('vitamin_a', ['Merah', 'Biru']);
            $table->string('bb')->nullable();
            $table->integer('tb')->nullable();
            $table->enum('aksi_eksklusif', ['Ya', 'Tidak'])->nullable();
            $table->enum('inisiatif_menyusui_dini', ['Ya', 'Tidak'])->nullable();
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
        Schema::dropIfExists('timbangdan_vitamins');
    }
}
