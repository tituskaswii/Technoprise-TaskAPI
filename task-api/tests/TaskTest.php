<?php

namespace Tests;  // Add this if missing

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Models\Task;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateTask()
    {
        $data = [
            'title' => 'New Task',
            'description' => 'Task description',
            'due_date' => '2024-12-31',
        ];

        $this->post('/api/tasks', $data)
             ->seeStatusCode(201)
             ->seeJson(['title' => 'New Task']);
    }

    public function testGetTasks()
    {
        factory(Task::class)->create([
            'title' => 'Sample Task',
            'due_date' => '2024-12-31',
        ]);

        $this->get('/api/tasks')
             ->seeStatusCode(200)
             ->seeJson(['title' => 'Sample Task']);
    }

    public function testUpdateTask()
    {
        $task = factory(Task::class)->create();

        $data = [
            'title' => 'Updated Task',
            'due_date' => '2024-12-31',
        ];

        $this->put("/api/tasks/{$task->id}", $data)
             ->seeStatusCode(200)
             ->seeJson(['title' => 'Updated Task']);
    }

    public function testDeleteTask()
    {
        $task = factory(Task::class)->create();

        $this->delete("/api/tasks/{$task->id}")
             ->seeStatusCode(204);
    }
}
