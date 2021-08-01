<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('id', '>', '5')
            ->each(function (User $user){
                $event = Event::factory(2)->make();
                $user->event()->saveMany($event);
            });
    }
}
