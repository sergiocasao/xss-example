<?php

use Illuminate\Database\Seeder;

class FriendshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Friendship::class, 50)->create();
    }
}
