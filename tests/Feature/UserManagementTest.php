<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function name_email_and_password_are_required()
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('dashboard.users.store'), []);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);
    }

    /** @test */
    public function email_must_be_valid()
    {
        $admin = User::factory()->create();

        $payload = [
            'name' => 'John Doe',
            'email' => 'not-an-email',
            'password' => 'secret123',
        ];

        $response = $this->actingAs($admin)->post(route('dashboard.users.store'), $payload);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function email_must_be_unique()
    {
        $admin = User::factory()->create();
        $existingUser = User::factory()->create(['email' => 'existing@example.com']);

        $payload = [
            'name' => 'John Doe',
            'email' => 'existing@example.com',
            'password' => 'secret123',
        ];

        $response = $this->actingAs($admin)->post(route('dashboard.users.store'), $payload);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function password_must_be_minimum_6_characters()
    {
        $admin = User::factory()->create();

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '123', // too short
        ];

        $response = $this->actingAs($admin)->post(route('dashboard.users.store'), $payload);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function valid_data_passes_validation()
    {
        $admin = User::factory()->create();

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret123',
        ];

        $response = $this->actingAs($admin)->post(route('dashboard.users.store'), $payload);

        // Should redirect without validation errors
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('dashboard.users.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);
    }

    public function test_a_basic_request(): void
    {
        $admin = User::factory()->create();
        $response = $this->actingAs($admin)->get('/dashboard/users');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_user_from_dashboard(): void
    {
        $admin = User::factory()->create();

        $payload = [
            'name' => 'John Tester',
            'email' => 'john@example.com',
            'password' => 'secret123',
        ];

        $response = $this->actingAs($admin)->post(route('dashboard.users.store'), $payload);

        $response
            ->assertRedirect(route('dashboard.users.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Tester',
        ]);

        $createdUser = User::where('email', 'john@example.com')->first();

        $this->assertNotNull($createdUser);
        $this->assertTrue(Hash::check('secret123', $createdUser->password));
    }

    public function test_admin_can_toggle_user_suspension_status(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create(['suspended_at' => null]);

        $response = $this->actingAs($admin)->patch(route('dashboard.users.suspend', $user));

        $response
            ->assertRedirect(route('dashboard.users.index'))
            ->assertSessionHas('success');

        $this->assertNotNull($user->fresh()->suspended_at);

        $response = $this->actingAs($admin)->patch(route('dashboard.users.suspend', $user));

        $response
            ->assertRedirect(route('dashboard.users.index'))
            ->assertSessionHas('success');

        $this->assertNull($user->fresh()->suspended_at);
    }

    public function test_user_can_update_profile_with_new_avatar(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'profile' => 'profiles/old.jpg',
        ]);

        Storage::disk('public')->put('profiles/old.jpg', 'old-image-content');

        $payload = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '0987654321',
            'address' => '123 Updated Street',
            'bio' => 'Updated bio for the current user.',
            'profile' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        $response = $this->actingAs($user)->patch(route('dashboard.profile'), $payload);

        $response
            ->assertRedirect(route('dashboard.profile'))
            ->assertSessionHas('success');

        $user->refresh();

        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
        $this->assertEquals('0987654321', $user->phone);
        $this->assertEquals('123 Updated Street', $user->address);
        $this->assertEquals('Updated bio for the current user.', $user->bio);

        Storage::disk('public')->assertMissing('profiles/old.jpg');
        Storage::disk('public')->assertExists($user->profile);
    }
}

