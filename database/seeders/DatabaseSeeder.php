<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'Alan Santos',
            'email' => 'alan.santos@email.com',
            'password' => Hash::make('password'),
        ]);
        $user2 = User::factory()->create();

        Task::factory(3)->create(['user_id' => $user1->id]);
        Task::factory(2)->create(['user_id' => $user2->id]);
    }
}
