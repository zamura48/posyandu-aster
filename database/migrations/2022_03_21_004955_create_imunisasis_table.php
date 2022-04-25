<?php

use App\Models\Balita;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImunisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imunisasis', function (Blueprint $table) {
            $table->id();
            $table->date('hb0')->nullable();
            $table->date('bcg')->nullable();
            $table->date('p1')->nullable();
            $table->date('dpt1')->nullable();
            $table->date('p2')->nullable();
            $table->date('pcv1')->nullable();
            $table->date('dpt2')->nullable();
            $table->date('p3')->nullable();
            $table->date('pcv2')->nullable();
            $table->date('dpt3')->nullable();
            $table->date('p4')->nullable();
            $table->date('pcv3')->nullable();
            $table->date('ipv')->nullable();
            $table->date('campak')->nullable();
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
        Schema::dropIfExists('imunisasis');
    }
}
