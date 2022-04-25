<?php

use App\Models\Kader;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbuKBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibu_kb_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->string('nama_istri', 25);
            $table->date('tanggal_lahir');
            $table->longText('alamat');
            $table->string('pekerjaan_istri');
            $table->string('nomor_telepon', 15);
            $table->string('nama_suami', 25);
            $table->string('pekerjaan_suami');
            $table->integer('jumlah_anak');
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
        Schema::dropIfExists('ibu_kb_s');
    }
}
