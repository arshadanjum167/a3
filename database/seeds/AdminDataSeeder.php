<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Insert([
            'full_name' => 'Admin',
            'email' => 'admin@standard.com',
            'password' => bcrypt('123456'),
            'actor'=>1,
        ]);
    }
}
