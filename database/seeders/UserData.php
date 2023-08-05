<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Administrator',
                'username' =>'admin',
                'password' =>bcrypt('123456'),
                'level'=>1,
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Wartawan',
                'username' =>'riau pos
                ',
                'password' =>bcrypt('123456'),
                'level'=>2,
                'email' => 'riaupos@gmail.com',
            ],
            [
                'name' => 'KepalaBidang',
                'username' =>'kabid',
                'password' =>bcrypt('123456'),
                'level'=>3,
                'email' => 'kabid@gmail.com',
            ],
        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
