<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::truncate();
        // Category::truncate();
        // Post::truncate();

        // creating one user for 5 post
        // create user with only name other fields can be random
        $user = User::factory()->create([
            "name" => "Akshay P M",
        ]);

        Post::factory(10)->create([
            "user_id" => $user->id,
        ]);

        // $personal = Category::create([
        //     "name"=> "Personal",
        //     "slug"=> "personal"
        // ]);

        // $work = Category::create([
        //     "name"=> "Work",
        //     "slug"=> "work"
        // ]);

        // $family = Category::create([
        //     "name"=> "Family",
        //     "slug"=> "family"
        // ]);

        // Post::create([
        //     "user_id" => $user->id,
        //     "category_id" => $personal -> id,
        //     "title" => "My Personal Post",
        //     "slug" => "my-personal-post",
        //     "excerpt" => '<p>Lorem ipum text</p>',
        //     "body" => '<p>This is my personal post</p>'
        // ]);

        // Post::create([
        //     "user_id" => $user->id,
        //     "category_id" => $work -> id,
        //     "title" => "My Work Post",
        //     "slug" => "my-work-post",
        //     "excerpt" => '<p>Lorem ipum text</p>',
        //     "body" => '<p>This is my work post</p>'
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
