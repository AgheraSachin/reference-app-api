<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);
    }
}
