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
                'name' => 'raihan',
                'email'  => 'raihan@gmail.com',
                'password' => \Illuminate\Support\Facades\Hash::make('raihan'),
                'role' => '1',
            ]);
    }
}
