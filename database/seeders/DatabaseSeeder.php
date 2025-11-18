<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'hh4626783@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);

        $types = [
            'Web Application',
            'Mobile Application',
            'E-commerce Platform',
            'Portfolio Website',
            'SaaS Product',
            'CRM System',
            'HR Management System',
            'Inventory Management System',
            'Learning Management System (LMS)',
            'Booking System',
            'Point of Sale (POS)',
            'Restaurant Ordering System',
            'Blog / CMS',
            'Social Media Platform',
            'Marketplace Platform',
            'AI Chatbot Project',
            'API Development',
            'Landing Page',
            'Finance / Accounting Tool',
            'Task Management Tool',
            'Healthcare System',
            'Real Estate Platform',
            'Travel & Tourism Platform',
            'News / Magazine Website',
            'Analytics Dashboard'
        ];

        foreach ($types as $index => $type) {
            ProjectType::create([
                'name' => $type,
                'slug' => Str::slug($type),
                'description' => $type . ' description.',
                'display_order' => $index + 1,
                'created_by' => 1, // default user
                'updated_by' => 1,
            ]);
        }
    
    }
}
