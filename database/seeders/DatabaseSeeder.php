<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      *
//      * @return void
//      */
//     public function run()
//     {
//          \App\Models\User::factory(10)->create();
//     }
// }

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['Ahmed', 'ahmed', '12345'],
            ['Ali', 'ali', '12345'],
            ['Youssef', 'youssef', '12345'],
            ['Saleh', 'saleh', '12345'],
            ['Ramzi', 'ramzi', '12345'],
            ['Waleed', 'waleed', '12345'],
            ['Rahim', 'rahim', '12345'],
            ['Noor', 'noor', '12345'],
            ['Hazem', 'hazem', '12345'],
            ['Mohamed', 'mohamed', '12345'],
            ['Ihab', 'ihab', '12345'],
            ['Shams', 'shams', '12345'],
            ['Ibrahim', 'ibrahim', '12345'],
            ['Ramy', 'ramy', '12345'],
            ['Amr', 'amr', '12345'],
            ['Wael', 'wael', '12345'],
        ];
        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user[0],
                'email' => $user[1] . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}

