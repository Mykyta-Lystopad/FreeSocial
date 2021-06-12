<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'first_name'=>'Никита',
            'last_name'=>'Листопад',
            'birthDay'=> '1987',
            'age'=> 0,
            'email'=>'niko-liko0@rambler.ru',
            'city'=>'Полтава',
            'mobile' => '38066*****38',
            'role'=>'admin',


        ]);
        User::factory()->create([
            'first_name'=>'Ваня',
            'last_name'=>'Кочерга',
            'birthDay'=> '2006',
            'age'=> 0,
            'email'=>'vanRun@gmail.com',
            'city'=>'Полтава',
            'mobile' => '38066*****03',
            'role'=>'admin',
        ]);

        User::factory()->count(10)->create([
            'role'=>'user',
        ]);

    }
}
