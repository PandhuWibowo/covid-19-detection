<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id_user' => 1,
            'nama' => 'John Doe',
            'alamat' => 'Kota X',
            'no_telp' => '08911111111',
            'jabatan' => 'superAdmin',
            'password' => '$2y$10$blwhhIUX/q2uoPCmERd0Iuyq5BNyvC4wKSKkhjvFZtVdWTiSDU54a'
        ]);
    }
}
