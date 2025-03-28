<?php


namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Candidature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CandidatureControllerTest extends TestCase
{

   

    public function test_show()
{
    $user = User::factory()->create([
        'role' => 'candidat',
    ]);

    $this->actingAs($user,'api');

    $candidature = Candidature::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->get("/api/candidature/{$candidature->id}");

    $response->assertStatus(200);
}



public function test_index_with_candidat_role()
    {
        $user = User::factory()->create([
            'role' => 'candidat',
        ]);

        $this->actingAs($user, 'api');

        $candidature = Candidature::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->get("/api/candidature");

        $response->assertStatus(200);

        // $response->assertJsonStructure([
        //     'status',
        //     'annonces' => [
        //         '*' => [
        //             'id',
        //             'cv',
        //             'lettre_motivation',
        //         ]
        //     ]
        // ]);
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
        ])->get("/api/candidature");

        $response->assertStatus(200);
    }


    
        public function test_delete()
        {
            $user = User::factory()->create([
                'role' => 'candidat',
            ]);
    
            $this->actingAs($user, 'api');
    
            $candidature = Candidature::factory()->create([
                'user_id' => $user->id,
            ]);
    
            $response = $this->delete("/api/candidature/{$candidature->id}");
    
            $response->assertStatus(200);
            $response->assertJson([
                'message' => 'Candidature deleted successfully',
            ]);
    
            $this->assertDatabaseMissing('candidatures', [
                'id' => $candidature->id,
            ]);
        }



public function test_update()
{
    $user = User::factory()->create([
        'role' => 'candidat',
    ]);

    $this->actingAs($user, 'api');

    $candidature = Candidature::factory()->create([
        'user_id' => $user->id,
    ]);


    $updatedData = [
        'lettre_motivation' => 'Description mise à jour', 
    ];

    $response = $this->patch("/api/candidature/{$candidature->id}", $updatedData);

    $response->assertStatus(200);

    $response->assertJsonFragment([
        'lettre_motivation' => 'Description mise à jour',
    ]);

    $this->assertDatabaseHas('candidatures', [
        'id' => $candidature->id,
        'lettre_motivation' => 'Description mise à jour',
    ]);
}


}
