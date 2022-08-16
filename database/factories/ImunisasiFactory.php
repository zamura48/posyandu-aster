<?php

namespace Database\Factories;

use App\Models\Imunisasi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImunisasiFactory extends Factory
{
    protected $model = Imunisasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hb0' => Carbon::today()->subDays(rand(0, 365)),
            'balita_id' => random_int(0, 20),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
