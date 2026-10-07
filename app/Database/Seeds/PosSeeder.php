<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosSeeder extends Seeder
{
    public function run()
    {
        $this->call('CustomerSeeder');
        $this->call('UserSeeder');
    }
}
