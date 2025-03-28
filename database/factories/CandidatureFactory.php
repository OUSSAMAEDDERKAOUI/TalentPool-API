<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Candidature;
use  App\models\User;
use App\Models\Annonce;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\candidature>
 */
class CandidatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * 
     * @return array<string, mixed>
     */
     protected $model=Candidature::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), 
            'cv' => $this->faker->word() . '.pdf', 
            'lettre_motivation' => $this->faker->paragraph(), 
            'annonce_id' => Annonce::factory(), 
            'status' => $this->faker->randomElement(['en_attente', 'accepté', 'refusé']), 
        ];
    }
}
