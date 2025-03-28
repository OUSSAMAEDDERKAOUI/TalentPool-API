<?php


namespace Database\Factories;

use App\Models\Annonce;
use App\Models\User; // N'oubliez pas d'importer le modèle User
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnonceFactory extends Factory
{
    /**
     * Le modèle que cette factory va générer.
     *
     * @var string
     */
    protected $model = Annonce::class;

    /**
     * Définir le modèle par défaut pour la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), 
            'title' => $this->faker->sentence(), 
            'description' => $this->faker->paragraph(),
        ];
    }
}

