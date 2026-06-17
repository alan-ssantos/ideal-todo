<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('an authenticated user can create a task', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $payload = [
        'title' => 'Comprar leite',
        'description' => 'Passar no mercado depois do trabalho',
        'due_date' => now()->addDay()->format('Y-m-d H:i:s'),
        'status' => 'pending',
    ];

    $response = $this->postJson('/api/tasks', $payload);

    $response->assertCreated()
        ->assertJsonPath('data.title', $payload['title'])
        ->assertJsonPath('data.description', $payload['description'])
        ->assertJsonPath('data.status', $payload['status']);

    $this->assertDatabaseHas('tasks', [
        'user_id' => $user->id,
        'title' => $payload['title'],
        'description' => $payload['description'],
        'status' => $payload['status'],
        'due_date' => $payload['due_date'],
    ]);
});

test('a user cannot access another users task', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $task = Task::factory()->for($owner)->create();

    Sanctum::actingAs($otherUser);

    $response = $this->getJson('/api/tasks/'.$task->id);

    $response->assertNotFound();
});
