<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testRegister()
    {
        $userData = [
            'name' => 'akil',
            'email' => 'akil@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user',
                    'token',
                ],
            ]);
        $this->assertDatabaseHas('users', [
            'email' => 'akil@example.com',
        ]);
    }

    public function testLogin(){
        $user = User::factory()->create([
            'email' => 'akil@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $credentials = [
            'email' => 'akil@example.com',
            'password' => 'password',
        ];
        $response = $this->postJson('/api/login',$credentials);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'user' ,
                'token' ,
            ]
        ]);

        $this->assertAuthenticated();
    }

    public function testLogout(){
        $user = User::factory()->create([
            'email' => 'akil@example.com',
            'password' => bcrypt('password'),
        ]);
        $credentials = [
            'email' => 'akil@example.com',
            'password' => 'password',
        ];
        $response = $this->postJson('/api/login',$credentials);
        

    }

}
