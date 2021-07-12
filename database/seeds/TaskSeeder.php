<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Task;
use App\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            $newTask = new Task();
            $newTask->title = $faker->sentence(4);
            $newTask->content = $faker->text(100);
            $newTask->user_id = rand(1,Count(User::all()->toArray()));
            $newTask->save();
        }
    }
}
