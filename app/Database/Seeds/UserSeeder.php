<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $password = password_hash('pos12345', PASSWORD_DEFAULT);

        $users = [
            [
                'username'   => 'mgarcia',
                'full_name'  => 'Miguel Garcia',
                'password'   => $password,
                'created_at' => '2026-10-01 08:00:00',
            ],
            [
                'username'   => 'jtorres',
                'full_name'  => 'Jasmine Torres',
                'password'   => $password,
                'created_at' => '2026-10-01 08:10:00',
            ],
            [
                'username'   => 'rsalazar',
                'full_name'  => 'Rina Salazar',
                'password'   => $password,
                'created_at' => '2026-10-01 08:20:00',
            ],
            [
                'username'   => 'dlim',
                'full_name'  => 'Daniel Lim',
                'password'   => $password,
                'created_at' => '2026-10-01 08:30:00',
            ],
            [
                'username'   => 'asoriano',
                'full_name'  => 'Andrea Soriano',
                'password'   => $password,
                'created_at' => '2026-10-01 08:40:00',
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
