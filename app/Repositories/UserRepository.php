<?php 
// 
namespace App\Repositories;

use App\Models\User;
use App\Models\Recruteur;
use App\Models\Candidat;

class UserRepository
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    // Vérifier si l'email est unique
    public function isEmailUnique($email)
    {
        return $this->userModel->where('email', $email)->doesntExist();
    }

    // Créer un utilisateur avec les données fournies
    public function createUser(array $userData)
    {
        if (isset($userData['photo'])) {
            $userData['photo'] = $userData['photo']->store('profil_photos', 'public');
        }

        $user = User::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'phone' => $userData['phone'],
            'email' => $userData['email'],
            'password' => $userData['password'],  
            'status' => $userData['status'],
            'role' => $userData['role'],
            'photo' => $userData['photo'] ?? null,
        ]);

        if ($user->role === 'recruteur') {
            Recruteur::create([
                'user_id' => $user->id,
                'company' => $userData['company'],
                'poste' => $userData['poste'],
                'sector' => $userData['sector'],
                'city' => $userData['city'],
            ]);
        } elseif ($user->role === 'candidat') {
            Candidat::create([
                'user_id' => $user->id,
                'bio' => $userData['bio'],
                'fonction' => $userData['fonction'],
                'niveau' => $userData['niveau'],
                'experience' => $userData['experience'],
            ]);
        }

        return $user;  
    }

    public function findByCredentials(array $credentials)
    {
        return User::where('email', $credentials['email'])->first();
    }
}
