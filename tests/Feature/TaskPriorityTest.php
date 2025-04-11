<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use Carbon\Carbon;

class TaskPriorityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_tasks_sorted_by_priority_score()
    {
        Carbon::setTestNow(Carbon::parse('2024-01-01 12:00:00'));

        //Задача с самым большим приоритетом (важность 5, срок через 1 день)
        $task1 = Task::factory()->create([
            'importance' => 5,
            'deadline' => Carbon::now()->addDays(1),
        ]);

        // Менее приоритетная (важность 3, срок через 2 дня)
        $task2 = Task::factory()->create([
            'importance' => 3,
            'deadline' => Carbon::now()->addDays(2),
        ]);

        // Просроченная задача (priority_score будет 0)
        $task3 = Task::factory()->create([
            'importance' => 4,
            'deadline' => Carbon::now()->subDays(1),
        ]);

        $response = $this->getJson('/api/tasks/priority');

        $response->assertStatus(200);

        $responseData = $response->json('data');

        // Проверяем порядок задач
        $this->assertEquals($task1->id, $responseData[0]['id']);
        $this->assertEquals($task2->id, $responseData[1]['id']);
        $this->assertEquals($task3->id, $responseData[2]['id']);

        // Проверяем наличие нужных полей
        $this->assertArrayHasKey('priority_score', $responseData[0]);
        $this->assertArrayHasKey('is_overdue', $responseData[2]);
    }
}
