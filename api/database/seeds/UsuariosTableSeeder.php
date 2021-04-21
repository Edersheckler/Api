<?php

use App\Models\Usuarios;
use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        factory(Usuarios::class, 10)->create();
     

       
    }
}
