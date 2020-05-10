<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate(['email'=>'jose@mail.com'],[
          'name'=>'jose',
          'password'=>Hash::make('123456')
        ]);

        \App\User::firstOrCreate(['email'=>'maria@mail.com'],[
          'name'=>'Maria',
          'password'=>Hash::make('123456')
        ]);



        echo "Usuários criados! \n";
    }
}
