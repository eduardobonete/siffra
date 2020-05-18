<?php

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
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@siffra.com.br',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@siffra.com.br',
            'password' => Hash::make('123456'),
        ]);
    }
}
