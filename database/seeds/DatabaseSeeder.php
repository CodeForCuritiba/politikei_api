<?php

use App\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Usuario::create([
            'usuario' => 'neri',
            'senha' => strtoupper(md5('123qwe')),
        ]);

        Model::reguard();
    }
}
