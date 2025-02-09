<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        

        Language::create([
            'slug' => 'Laravel',
            'name' => 'Laravel',
        ]);
        Language::create([
            'slug' => 'Javascript',
            'name' => 'Javascript',
        ]);
        Language::create([
            'slug' => 'Python',
            'name' => 'Python',
        ]);
        
        Category::create([
            'slug' => 'web-dev',
            'name' => 'Web Development',
        ]);

        Category::create([
            'slug' => 'web-design',
            'name' => 'Web Design',
        ]);
        Category::create([
            'slug' => 'mobile-dev',
            'name' => 'Mobile Development',
        ]);
    }
}
