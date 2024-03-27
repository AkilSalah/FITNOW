<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Progression;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $user = User::factory()->create();
        $progressions = Progression::factory(3)->create([
            'userId' => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->getJson('/api/Progression');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'progressions' => [
                    '*' => [
                        'id',
                        'mensurations' => [
                            'poids',
                            'Mollet',
                            'Bras',
                            'Poitrine',
                            'Hauteur',
                        ],
                        'performances' => [
                            'TempsDeCourse',
                            'PoidsLeve',
                        ],
                        'status',
                        'relationShips' => [
                            'id',
                            'user name',
                        ],
                    ],
                ],
            ],
        ]);
    }


    public function test_store()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $progressionData = [
            'poids' => 70,
            'Poitrine' => 100,
            'Mollet' => 35,
            'Bras' => 30,
            'Hauteur' => 180,
            'PoidsLeve' => 50,
            'TempsDeCourse' => 30,
        ];

        $response = $this->postJson('/api/Progression', $progressionData);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'message',
                'Progression' => [
                    'id',
                    'mensurations' => [
                        'poids',
                        'Mollet',
                        'Bras',
                        'Poitrine',
                        'Hauteur',
                    ],
                    'performances' => [
                        'TempsDeCourse',
                        'PoidsLeve',
                    ],
                    'status',
                    'relationShips' => [
                        'id',
                        'user name',
                    ],
                ],
            ],
        ]);
    }


    public function test_update()
    {
        $user = User::factory()->create();
        $progression = Progression::factory()->create([
            'userId' => $user->id,
        ]);

        $progressionUpdate = [
            'poids' => 75,
            'Poitrine' => 100,
            'Mollet' => 35,
            'Bras' => 30,
            'Hauteur' => 180,
            'PoidsLeve' => 50,
            'TempsDeCourse' => 30,
        ];
        $response = $this->actingAs($user)
            ->patchJson("/api/Progression/{$progression->id}", $progressionUpdate);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [

                    'id' => $progression->id,
                    'mensurations' => [
                        'poids' => $progressionUpdate['poids'],
                        'Mollet' => $progressionUpdate['Mollet'],
                        'Bras' => $progressionUpdate['Bras'],
                        'Poitrine' => $progressionUpdate['Poitrine'],
                        'Hauteur' => $progressionUpdate['Hauteur'],
                    ],
                    'performances' => [
                        'TempsDeCourse' => $progressionUpdate['TempsDeCourse'],
                        'PoidsLeve' => $progressionUpdate['PoidsLeve'],
                    ],
                    'status' => 'NonTerminé',
                    'relationShips' => [
                        'id' => $user->id,
                        'user name' => $user->name,
                    ],
                ],

            ]);
    }

    public function test_termine()
    {
        $user = User::factory()->create();
        $progression = Progression::factory()->create([
            'userId' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->patchJson("/api/Progression/{$progression->id}/completed");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'Request was succesful.',
                'message' => null,
                'data' => [
                    'message' => 'completed',
                    'progression' => [
                        'id' => (string)$progression->id, 
                        'mensurations' => [
                            'poids' => $progression->poids,
                            'Mollet' => $progression->Mollet,
                            'Bras' => $progression->Bras,
                            'Poitrine' => $progression->Poitrine,
                            'Hauteur'  => $progression->Hauteur,
                        ],
                        'performances' => [
                            'TempsDeCourse'  => $progression->TempsDeCourse,
                            'PoidsLeve'  => $progression->PoidsLeve,
                        ],
                        'status' => 'terminé',
                        'relationShips' => [
                            'id' => $user->id,
                            'user name' => $user->name,
                        ],
                    ],
                ],
            ]);
    }



     public function test_destroy() {

        $user = User::factory()->create();
        $progression = Progression::factory()->create([
            'userId' => $user->id,
        ]);

        $response = $this->actingAs($user)
        ->deleteJson("/api/Progression/{$progression->id}");
        $response->assertStatus(200)
        ->assertJson([
            "status"=> "Request was succesful.",
            "message"=> null,
        "data" => [
        "message"=> "Progression deleted successfully"
        ],
        ]);

     }
}
