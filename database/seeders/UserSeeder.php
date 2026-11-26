<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{
    public function run(): void{
        User::create([
            'name'=>'Admin01',
            'email'=>'admin01@gmail.com',
            'phone'=> '081283123121',
            'role'=> 'admin',
            'password'=> '1admin123'
        ]);
        User::create([
            'name'=>'Admin02',
            'email'=>'admin02@gmail.com',
            'phone'=> '081283123122',
            'role'=> 'admin',
            'password'=> '2admin123'
        ]);
        User::create([
            'name'=>'User01',
            'nim'=> 'D1111111111',
            'email'=>'User01@gmail.com',
            'phone'=> '081111111111',
            'role'=> 'user',
            'password'=> '1user123'
        ]);

        // keterbatasan: email tidak mengecek apakah email benar benar available
    }
}
