<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Importer Str ici
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * Le nom du modèle associé à la factory.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Définir l'état par défaut de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'photo' => $this->faker->imageUrl(640, 480, 'people', true),
            'status' => $this->faker->randomElement(['actif', 'inactif']),
            'role' => $this->faker->randomElement(['admin', 'recruteur', 'candidat']),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10), // Utilisation de Str::random ici
        ];
    }
}
