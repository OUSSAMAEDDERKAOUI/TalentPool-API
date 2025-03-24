<?php 
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function findByUsername($username)
    {
        return $this->userModel->where('username', $username)->first();
    }

    public function isEmailUnique($email)
    {
        return $this->userModel->where('email', $email)->doesntExist();
    }

    public function createUser(array $userData)
    {
        if (isset($userData['photo'])) {
            $userData['photo'] = $userData['photo']->store('profil_photos', 'public');
        }
        return $this->userModel->create($userData);
    }

    public function findByCredentials(array $credentials)
    {
        return User::where('email', $credentials['email'])->first();
    }

   
}