<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Annonce;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnnonceControllerTest extends TestCase
{
    public function test_show()
    {
        $user = User::factory()->create([
            'role' => 'recruteur',
        ]);

        $this->actingAs($user,'api');

        $annonce = Annonce::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->get("/api/annonce/{$annonce->id}");

        $response->assertStatus(200);
        $response->assertJson(['annonce' => $annonce->toArray()]);
    }

    public function test_index_with_recruteur_role()
    {
        $user = User::factory()->create([
            'role' => 'recruteur',
        ]);

        $this->actingAs($user, 'api');

        $annonces = Annonce::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->get("/api/annonce");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'annonces' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                ]
            ]
        ]);
    }

    public function test_index_with_jwt()
    {
        $user = User::factory()->create([
            'role' => 'candidat',
        ]);
        $this->actingAs($user, 'api');

        $token = $user->createToken('Test Token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("/api/annonce");

        $response->assertStatus(403);
    }


    
        public function test_delete()
        {
            $user = User::factory()->create([
                'role' => 'recruteur',
            ]);
    
            $this->actingAs($user, 'api');
    
            $annonce = Annonce::factory()->create([
                'user_id' => $user->id,
            ]);
    
            $response = $this->delete("/api/annonce/{$annonce->id}");
    
            $response->assertStatus(200);
            $response->assertJson([
                'message' => 'Annonce deleted successfully',
            ]);
    
            $this->assertDatabaseMissing('annonces', [
                'id' => $annonce->id,
            ]);
        }

        public function test_update()
        {
            $user = User::factory()->create([
                'role' => 'recruteur',
            ]);
    
            $this->actingAs($user, 'api');
    
            $annonce = Annonce::factory()->create([
                'user_id' => $user->id,
            ]);
    
            $updatedData = [
                'title' => 'Titre mis à jour',
                'description' => 'Description mise à jour',
            ];
    
            $response = $this->patch("/api/annonce/{$annonce->id}", $updatedData);
    
            $response->assertStatus(200);
    
            $response->assertJsonFragment([
                'title' => 'Titre mis à jour',
                'description' => 'Description mise à jour',
            ]);
    
            $this->assertDatabaseHas('annonces', [
                'id' => $annonce->id,
                'title' => 'Titre mis à jour',
                'description' => 'Description mise à jour',
            ]);
        }

}
