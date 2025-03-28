<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Exécutez le seeder.
     *
     * @return void
     */
    public function run()
    {
        // Créer 10 utilisateurs
        User::factory(10)->create();
    }
}
