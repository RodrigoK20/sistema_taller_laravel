<?php

use Illuminate\Database\Seeder;
use App\Business;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Business::create([
            'name'=>'Nombre de la empresa',
            'description'=>'Descripción de la empresa ',
            'logo'=>'logo.png',
            'mail'=>'mail123@gmail.com',
            'address'=>'888 Cummings Vista Apt. 101, Susanbary, NY 9765',
            'ruc'=>'15678986873',
            'phone'=>'78876567'
        ]);
    }
}
