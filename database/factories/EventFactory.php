<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'eventImages' => 'C:\OpenServer\domains\backEnd\storage\events\pivicha.jpeg',
//            'eventImages' => 'http://nikita-listopad-portfolio.pp.ua/FreeSocial/storage/events\pivicha.jpeg',
            'title' => 'Go to Pivicha',
            'description' => $this->faker->realTextBetween(150, 200),
            'coordinates' => 'https://www.google.com/maps/place/%D0%91%D1%8B%D0%B2%D1%88%D0%B8%D0%B9+%D0%B4%D0%B2%D0%BE%D1%80%D0%B5%D1%86+%D0%BA%D1%83%D0%BB%D1%8C%D1%82%D1%83%D1%80%D1%8B+%D0%AD%D0%BD%D0%B5%D1%80%D0%B3%D0%B5%D1%82%D0%B8%D0%BA/@51.4066963,30.0361971,14z/data=!4m13!1m7!3m6!1s0x41297bd6ae28a8d9:0x58ee25d2578aa9f2!2z0JPQsNGC0LrQsCwg0KHRg9C80YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsIDQxNzI0!3b1!8m2!3d51.1575463!4d34.0722367!3m4!1s0x472a7c5dd6833d17:0x51f528bbc76dc770!8m2!3d51.40667!4d30.0567397',
            'departure' => $this->faker->dateTimeThisMonth
        ];
    }
}
