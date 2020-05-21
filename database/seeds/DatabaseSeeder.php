<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        factory(App\User::class, 10000)->create()->each(function ($user) {
            $user->save();
            for ($i = 0; $i < 3; $i++){
                $task = factory(App\Task::class)->make([
                    'user_id' => $user->id,
                ]);                
                $task->save();              
            }    
        });
      
    }
}
