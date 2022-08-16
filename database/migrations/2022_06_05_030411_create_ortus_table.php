<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrtusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ortus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->unique()->nullable();
            $table->string('nama_istri', 30);
            $table->date('tanggal_lahir')->nullable();
            $table->string('nomor_telepon', 15);
            $table->string('pekerjaan_istri', 15)->nullable();
            $table->string('nama_suami', 30)->nullable();
            $table->string('pekerjaan_suami', 15)->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->text('alamat');
            $table->integer('jumlah_anak')->nullable();
            $table->enum('status', ['Ibu Memiliki Anak', 'Ibu Hamil', 'Ibu KB'])->nullable();
            $table->foreignIdFor(User::class)->default(0);
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
        Schema::dropIfExists('ortus');
    }
}
