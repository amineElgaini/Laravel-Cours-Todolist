<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo user: test@example.com / password
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Fixed categories
        foreach ([
            'Work' => '#2563eb',
            'Personal' => '#16a34a',
            'Study' => '#9333ea',
            'Shopping' => '#ea580c',
        ] as $name => $color) {
            Category::create(['name' => $name, 'color' => $color]);
        }

        // 10 fake tasks for the demo user
        Task::factory()->count(10)->create(['user_id' => $user->id]);
    }
}
