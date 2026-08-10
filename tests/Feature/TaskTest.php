<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Notes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    //create a fake user and log them in for testing purposes
    private function loginUser(): User
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        return $user;
    }

    public function test_task_can_be_created()
    {
        $this->loginUser();

        $response = $this->post('/add-task', [
            'title' => 'Learn CI/CD',
            'content' => 'Build a Laravel CI/CD pipeline',
            'date' => '2026-08-10',
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('notes', [
            'title' => 'Learn CI/CD',
            'content' => 'Build a Laravel CI/CD pipeline',
            'date' => '2026-08-10',
            'status' => 'pending',
        ]);
    }

    public function test_task_requires_title()
    {
        $this->loginUser();

        $response = $this->post('/add-task', [
            'title' => '',
            'content' => 'Test content',
            'date' => '2026-08-10',
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_task_requires_content()
    {
        $this->loginUser();

        $response = $this->post('/add-task', [
            'title' => 'Test task',
            'content' => '',
            'date' => '2026-08-10',
        ]);

        $response->assertSessionHasErrors('content');
    }

    public function test_task_requires_date()
    {
        $this->loginUser();

        $response = $this->post('/add-task', [
            'title' => 'Test task',
            'content' => 'Test content',
            'date' => '',
        ]);

        $response->assertSessionHasErrors('date');
    }

    public function test_task_can_be_marked_as_completed()
    {
        $this->loginUser();

        $this->post('/add-task', [
            'title' => 'Complete CI/CD project',
            'content' => 'Finish the seven day project',
            'date' => '2026-08-10',
        ]);

        $task = Notes::first();

        $this->assertNotNull($task);

        $response = $this->get("/update-task/{$task->id}");

        $response->assertRedirect('/');

        $this->assertDatabaseHas('notes', [
            'id' => $task->id,
            'status' => 'completed',
        ]);
    }
}
