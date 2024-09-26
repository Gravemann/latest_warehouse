<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function Laravel\Prompts\password;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_see_login_page()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();

        $response->assertViewIs('auth.login');
    }

    /**
     * @test
     */
    public function user_cannot_view_login_page_when_authenticated()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('login');

        $response->assertRedirect('/home');
    }

    /**
     * @test
     */
    public function user_can_log_in(): void
    {
        $this->withExceptionHandling();

        $user = User::factory()->create();

        $data = array(
            'email' => $user->email,
            'password' => $user->password
        );

        $response = $this->post('/login', $data);

        $response->assertRedirectToRoute('brands.main');

        // $response->assertOk();
    } 
}
