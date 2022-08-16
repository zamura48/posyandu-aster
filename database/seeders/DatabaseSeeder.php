<?php

namespace Database\Seeders;

use App\Models\Imunisasi;
use App\Models\JenisVaksiImunisasi;
use App\Models\User;
use Database\Factories\ImunisasiFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
                'role' => "Ketua",
                'username' => "ketua",
                'name' => $this->faker->name(),
                'password' => Hash::make('ketua'),
                'status' => true
        ]);

        Ortu::create([
            'nik' => random_int(16,16),
            'nama_istri' => $user->name,
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address(),
            'nomor_telepon' => $this->faker->phoneNumber(),
            'user_id' => $user->id
        ]);

        $jenis_vaksin = [
            'hb0',
            'bcg',
            'p1',
            'dpt1',
            'p2',
            'pcv1',
            'dpt2',
            'p3',
            'pcv2',
            'dpt3',
            'p4',
            'pcv3',
            'ipv',
            'campak'
        ];

        foreach ($jenis_vaksin as $key => $value) {
            JenisVaksiImunisasi::create(['jenis_vaksin' => $value]);
        }
    }
}
