<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Candidature;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Retourne les statistiques globales de la plateforme sous forme de JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('index', User::class); 

        $totalUsers = User::count();

        $totalRecruteurs = User::where('role', 'recruteur')->count();

        $totalCandidats = User::where('role', 'candidat')->count();

        $totalAnnonces = Annonce::count();

        $totalCandidatures = Candidature::count();

        $acceptedCandidatures = Candidature::where('status', 'accepté')->count();

        $refusedCandidatures = Candidature::where('status', 'refusé')->count();

        $pendingCandidatures = Candidature::where('status', 'en_attente')->count();

        $newAnnoncesThisWeek = Annonce::where('created_at', '>=', Carbon::now()->startOfWeek())->count();

        $newCandidaturesThisWeek = Candidature::where('created_at', '>=', Carbon::now()->startOfWeek())->count();

        // $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subWeek())->count();

        return response()->json([
            'totalUsers' => $totalUsers,
            'totalRecruteurs' => $totalRecruteurs,
            'totalCandidats' => $totalCandidats,
            'totalAnnonces' => $totalAnnonces,
            'totalCandidatures' => $totalCandidatures,
            'acceptedCandidatures' => $acceptedCandidatures,
            'refusedCandidatures' => $refusedCandidatures,
            'pendingCandidatures' => $pendingCandidatures,
            'newAnnoncesThisWeek' => $newAnnoncesThisWeek,
            'newCandidaturesThisWeek' => $newCandidaturesThisWeek,
        ]);
    }
}
