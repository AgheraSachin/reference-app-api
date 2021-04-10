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
            'first_name' => 'Test1',
            'last_name' => 'Test1',
            'email' => 'test1@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test2',
            'last_name' => 'Test2',
            'email' => 'test2@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);
    }
}
