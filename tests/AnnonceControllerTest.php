<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Annonce;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AnnonceControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de la méthode index
     */
    // public function test_index()
    // {
    //     // Créer quelques annonces en utilisant les factories
    //     $annonces = Annonce::factory()->count(3)->create();

    //     // Effectuer une requête GET pour récupérer toutes les annonces
    //     $response = $this->get('/api/annonce');

    //     // Vérifier la réponse
    //     $response->assertStatus(200);
    //     $response->assertJsonStructure([
    //         'status',
    //         'annonces' => [
    //             '*' => [
    //                 'id',
    //                 'user_id',
    //                 'title',
    //                 'description',
    //             ]
    //         ]
    //     ]);
    // }

    // /**
    //  * Test de la méthode store
    //  */
    // public function test_store()
    // {
    //     // Données de test pour la création d'une annonce
    //     $data = [
    //         'user_id',
    //         'title' => 'Nouvelle annonce',
    //         'description' => 'Description de la nouvelle annonce',
    //     ];

    //     // Effectuer une requête POST pour créer une nouvelle annonce
    //     $response = $this->post('/api/annonce', $data);

    //     // Vérifier que la réponse a un statut HTTP 201 (créé)
    //     $response->assertStatus(201);
    //     $response->assertJson([
    //         'status' => "L'annonce a été ajoutée avec succès."
    //     ]);
    // }

    /**
     * Test de la méthode show
     */
    public function test_show()
    {
        // Créer un utilisateur avec un rôle adéquat
        $user = User::factory()->create([
            'role' => 'admin', // ou un autre rôle avec accès
        ]);
    
        // Authentifier l'utilisateur dans le test
        $this->actingAs($user);
    
        // Créer une annonce qui appartient à l'utilisateur
        $annonce = Annonce::factory()->create([
            'user_id' => $user->id, // Assurez-vous que l'annonce appartient à l'utilisateur
        ]);
    
        // Envoyer une requête GET pour obtenir l'annonce par ID
        $response = $this->get("/api/annonce/{$annonce->id}");
    
        // Vérifier que la réponse a un statut HTTP 200 (OK)
        $response->assertStatus(200);
        // Vérifier que la réponse JSON contient l'annonce
        $response->assertJson(['annonce' => $annonce->toArray()]);
    }


    /**
     * Test de la méthode update
     */
//    


    /**
     * Test de la méthode destroy
     */
//     public function test_destroy()
// {
//     $annonce = Annonce::factory()->create();

//     $response = $this->delete("/api/annonce/{$annonce->id}");
//     $response->assertStatus(200);
//     $response->assertJson(['message' => 'Annonce deleted successfully']);
// }

//     /**
//      * Test de la méthode getCandidaturesByAnnonce
//      */
//     public function test_getCandidaturesByAnnonce()
//     {
//         $annonce = Annonce::factory()->create();
    
//         $response = $this->get("/api/annonce/{$annonce->id}/candidatures");
//         $response->assertStatus(200);
//         $response->assertJsonStructure(['candidatures']);
//     }
    
}
