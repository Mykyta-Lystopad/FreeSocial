<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birthDay'=> mt_rand(1950, 2021),
            'age'=> mt_rand(18, 90),
            'email' => $this->faker->unique()->safeEmail,
            'verify_code'=> 'done',
            'email_verified_at' => now(),
            'password' => 123456,
            'mobile' => $this->faker->phoneNumber,
            'country'=> 'Україна',
            'city'=> $this->faker->city,
            'role'=>'user'

        ];
    }
}
