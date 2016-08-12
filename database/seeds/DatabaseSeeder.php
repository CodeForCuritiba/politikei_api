<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$password =  Crypt::encrypt('secret');
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'test@test.com',
            'password' => md5('secret'),
        ]);
    }
}
