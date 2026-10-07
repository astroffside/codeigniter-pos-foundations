<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username'   => 'mgarcia',
                'full_name'  => 'Miguel Garcia',
                'created_at' => '2026-10-01 08:00:00',
            ],
            [
                'username'   => 'jtorres',
                'full_name'  => 'Jasmine Torres',
                'created_at' => '2026-10-01 08:10:00',
            ],
            [
                'username'   => 'rsalazar',
                'full_name'  => 'Rina Salazar',
                'created_at' => '2026-10-01 08:20:00',
            ],
            [
                'username'   => 'dlim',
                'full_name'  => 'Daniel Lim',
                'created_at' => '2026-10-01 08:30:00',
            ],
            [
                'username'   => 'asoriano',
                'full_name'  => 'Andrea Soriano',
                'created_at' => '2026-10-01 08:40:00',
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
