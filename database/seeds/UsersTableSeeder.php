<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        Role::create([
            'name'=>'Admin',
            'slug'=>'admin',
            'special'=>'all-access',
        ]);


         //Usuario
        $user = User::create([
            'name'=>'Rodrigo',
            'email'=>'rviscarra2297@gmail.com',
            //rodrigo123
            'password'=>'$2y$10$Iu2NVTShBUYgXsPPfdGhnuMcvfx5K7okhZr8Ti57BiTfbAU8aJ.22',
        ]);

        $user->roles()->sync(1);
    }
}
