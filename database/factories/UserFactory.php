<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
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
