<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

use function PHPUnit\Framework\assertEquals;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_log_in_with_valid_credentials()
    {
    //Create a user with a password
    $password = 'password123';
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt($password), // Hashed password stored in the database
    ]);

    // Get to the login page
    $response = $this->get('/login');
    $this->assertEquals(200, $response->status());

    // Generate CSRF token manually
    $csrfToken = csrf_token();

    // Act: Attempt to log in with the correct credentials, including CSRF token
    $response = $this->post('/login', [
        '_token' => $csrfToken, // Include the CSRF token
        'email' => $user->email,
        'password' => $password, // Use the plain-text password, not $user->password
    ]);

    // Assert: The response is a redirect
    $this->assertEquals(302, $response->status());
    }


}
