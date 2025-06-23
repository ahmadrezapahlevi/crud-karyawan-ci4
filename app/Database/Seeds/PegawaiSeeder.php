<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'nama_pegawai' => $faker->name,
                'jabatan_id'   => $faker->randomElement(['1, 2, 3, 4, 5']),
                'alamat'       => $faker->address,          
                'telepon'      => $faker->phoneNumber,
                'foto_pegawai' => 'default.png',
            ];
        }
        $this->db->table('pegawai')->insertBatch($data);
    }
}
