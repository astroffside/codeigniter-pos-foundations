<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            [
                'full_name'  => 'Alicia Reyes',
                'email'      => 'alicia.reyes@example.com',
                'phone'      => '+63 917 555 0101',
                'created_at' => '2026-10-01 08:30:00',
            ],
            [
                'full_name'  => 'Marco Dela Cruz',
                'email'      => 'marco.delacruz@example.com',
                'phone'      => '+63 917 555 0102',
                'created_at' => '2026-10-01 08:45:00',
            ],
            [
                'full_name'  => 'Bianca Santos',
                'email'      => 'bianca.santos@example.com',
                'phone'      => '+63 917 555 0103',
                'created_at' => '2026-10-01 09:00:00',
            ],
            [
                'full_name'  => 'Noel Villanueva',
                'email'      => 'noel.villanueva@example.com',
                'phone'      => '+63 917 555 0104',
                'created_at' => '2026-10-01 09:15:00',
            ],
            [
                'full_name'  => 'Trisha Mendoza',
                'email'      => 'trisha.mendoza@example.com',
                'phone'      => '+63 917 555 0105',
                'created_at' => '2026-10-01 09:30:00',
            ],
        ];

        $this->db->table('customers')->insertBatch($customers);
    }
}
