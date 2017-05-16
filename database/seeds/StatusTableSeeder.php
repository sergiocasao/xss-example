<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        $faker = Faker\Factory::create();

        factory(App\Status::class, 50)->create()->each(function($status) use ($faker, $users){

                $sel_users = $users->random(rand(1, $users->count()));

                foreach ($sel_users as $user) {
                    App\Like::create([
                        'user_id' => $user->id,
                        'status_id' => $status->id,
                        'created_at' => $faker->dateTimeBetween($status->created_at),
                    ]);
                }

        });
    }
}
