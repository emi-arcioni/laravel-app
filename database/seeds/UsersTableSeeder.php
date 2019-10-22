<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 50)->create()->each(function ($user) {
        //     $user->entries()->save(factory(App\Entry::class)->make());
        // });

        factory(App\User::class, 20)->create()->each(function ($user) {
            $entries = factory(App\Entry::class, 5)->make();
            $entries->each(function($entry) use ($user) {
                $user->entries()->save($entry);
            });
            
            // print_r($entries->toArray());
            // $user->entries()->create($entries->toArray());
        });
    }
}
