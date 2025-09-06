<?php

namespace Tests\Feature\api\profile;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user, 'sanctum')
            ->withHeader('Accept', 'application/json')
            ->withHeader('Accept-Language', 'en');
    }


    #[Test]
    public function user_can_view_profile()
    {

        $this->getJson('api/profile')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $this->user->id,
                    'email' => $this->user->email,
                ],
                'status' => true,
                'message' => 'Profile retrieved successfully',
            ]);
    }

    #[Test]
    public function user_can_update_profile()
    {
        $this->putJson('api/profile', [

            'name' => 'Updated Name',
            'phone' => '01012345678'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status' => true,
                'message' => 'Profile updated successfully',
            ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'email' => 'updated@example.com',
            'name' => 'Updated Name',
            'phone' => '01012345678',
        ]);
    }

    #[Test]
    public function user_can_change_password()
    {

        $this->postJson('api/profile/change-password', [
            'current_password' => 'password',
            'password' => '564541nN@',
            'password_confirmation' => '564541nN@',
        ])
            ->assertStatus(200);

        $this->assertTrue(password_verify('564541nN@', $this->user->fresh()->password));
    }
}
