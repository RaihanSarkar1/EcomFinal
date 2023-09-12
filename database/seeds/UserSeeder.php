<?php

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
        \Illuminate\Support\Facades\DB::table('users')
            ->insert([
                'name' => 'seeder 1',
                'email'  => 'seeder@seeder.com',
                'password' => \Illuminate\Support\Facades\Hash::make('welcome'),
            ]);
    }
}
