<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed Blogs with images
        Blog::factory(10)->create()->each(function ($blog) {
            $faker = \Faker\Factory::create();

            // Generate a placeholder image
            $imageName = Str::random(10) . '.jpg';
            $imagePath = public_path('template/img/blogs/' . $imageName);

            // Ensure the directory exists
            if (!file_exists(public_path('template/img/blogs/'))) {
                mkdir(public_path('template/img/blogs/'), 0755, true);
            }

            // Download or generate a dummy image
            file_put_contents($imagePath, file_get_contents($faker->imageUrl(640, 480, 'blog', true, 'Faker Blog')));

            // Save the generated image name to the database
            $blog->update(['image' => $imageName]);
        });

    }
}
