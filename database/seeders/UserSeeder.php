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
//        $data = [
//            'first_name' => 'Test1',
//            'last_name' => 'Test1',
//            'email' => 'test1@test.com',
//            'password' => bcrypt('123456'),
//        ];
//        User::create($data);
//
//        $data = [
//            'first_name' => 'Test2',
//            'last_name' => 'Test2',
//            'email' => 'test2@test.com',
//            'password' => bcrypt('123456'),
//        ];
//        User::create($data);

        $data = [
            'first_name' => 'Test3',
            'last_name' => 'Test3',
            'email' => 'test3@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test4',
            'last_name' => 'Test4',
            'email' => 'test4@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test5',
            'last_name' => 'Test5',
            'email' => 'test5@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test6',
            'last_name' => 'Test6',
            'email' => 'test6@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test7',
            'last_name' => 'Test7',
            'email' => 'test7@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test8',
            'last_name' => 'Test8',
            'email' => 'test8@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test9',
            'last_name' => 'Test9',
            'email' => 'test9@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);

        $data = [
            'first_name' => 'Test10',
            'last_name' => 'Test10',
            'email' => 'test10@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($data);
    }
}
