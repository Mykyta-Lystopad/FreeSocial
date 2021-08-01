<?php

namespace Database\Factories;

use App\Models\User;
use File;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $filepath = storage_path('images');
//
//        if(!File::exists($filepath)) {
//            File::makeDirectory($filepath);
//
//        }
//        $filepath = storage_path('images');
        return [
//            'avatar'=> $this->faker->image($filepath,640,480, null, false),
//            'avatar'=> 'C:\OpenServer\domains\backEnd\storage\avatars\default_avatar.png',
            'avatar'=> 'http://nikita-listopad-portfolio.pp.ua/FreeSocial/storage/avatars/default_avatar.png',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birthDay'=>  $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')
                ->format('Y-m-d'),
            'age'=> mt_rand(18, 90),
            'email' => $this->faker->unique()->safeEmail,
            'verify_code'=> 'done',
            'email_verified_at' => now(),
            'mobile' => $this->faker->phoneNumber,
            'country'=> 'Україна',
            'city'=> $this->faker->city,
            'role'=>'user'

        ];
    }
}
