<?php

use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, rand(5,7))->create()->each(
            function($category) {
                factory(App\Task::class,rand(6,9))->create([
                    'category_id'=>$category->id
                ]);
            }
        );
    }
}
