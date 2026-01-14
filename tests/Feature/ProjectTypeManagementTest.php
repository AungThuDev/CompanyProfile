<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ProjectType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTypeManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_a_request()
    {
        $user = User::factory()->create();
        $type = ProjectType::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard/project-types');
        $response->assertStatus(200);
    }
}
