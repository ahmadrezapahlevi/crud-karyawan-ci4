<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'user',
            'nama' => 'Faiz Syauqi',
            'email'    => 'user@gmail.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ];
        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
