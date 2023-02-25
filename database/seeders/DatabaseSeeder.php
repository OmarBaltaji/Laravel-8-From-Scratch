<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Provider\Lorem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Post::truncate();
        // User::truncate();
        // Category::truncate();

        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My Family Post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => '<p>Lorem ipsum, dolor sit amet</p>',
        //     'body' => '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum eligendi sint rerum molestias laboriosam optio ex illo, facere maiores beatae autem fuga molestiae odit necessitatibus veniam voluptates. Cupiditate, quos corporis.</p>',
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My Work Post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => '<p>Lorem ipsum, dolor sit amet</p>',
        //     'body' => '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum eligendi sint rerum molestias laboriosam optio ex illo, facere maiores beatae autem fuga molestiae odit necessitatibus veniam voluptates. Cupiditate, quos corporis.</p>',
        // ]);
    }
}
