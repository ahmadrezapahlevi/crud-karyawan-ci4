<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'udin',
            'nama' => 'Udin Madindun',
            'email'    => 'udinmadindun@gmail.com',
            'role' => 'user',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ];
        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
