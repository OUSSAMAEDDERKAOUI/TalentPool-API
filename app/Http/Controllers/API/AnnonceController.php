<?php

namespace App\Http\Controllers\API;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Services\AnnonceService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Annonces\RequestAnnonce;
use App\Http\Requests\Annonces\UpdateAnnonceRequest;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class AnnonceController extends Controller
{

    protected $AnnonceService;

    public function __construct(AnnonceService $AnnonceService)
    {
        $this->AnnonceService = $AnnonceService;
    }

 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('index', Annonce::class); 

        $annonces=$this->AnnonceService->showAllAnnonces();
        return response()->json([
         'status'=>"l'affichage de toutes les annonces",
         'annonces'=>$annonces,
]);

    }
    public function showAll()
    {
        // $this->authorize('index', Annonce::class); 

        $annonces=$this->AnnonceService->index();
        return response()->json([
         'status'=>"l'affichage de toutes les annonces",
         'annonces'=>$annonces,
]);

    }

    
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(RequestAnnonce $request)
    {

        // $this->authorize('create', Annonce::class); 

        $validatedData = $request->validated();
    
        $annonce = $this->AnnonceService->registerAnnonce($validatedData);

        return response()->json([
            'status' => "L'annonce a été ajoutée avec succès.",
            'annonce' => $annonce,
        ], 201); 
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        $annonce->load('recruteur'); 
        return response()->json([
            'annonce' => $annonce
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annonce $Annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnonceRequest $request, Annonce $Annonce)
    {
        $this->authorize('update', $Annonce);

        $validatedData=$request->validated();

        $annonce = $this->AnnonceService->updateAnnonce($validatedData,$Annonce);

        return  response()->json([
            'annonce' => $annonce,
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Annonce $annonce)
    {
        // Vérifie si l'utilisateur est authentifié
        // $user = auth()->user();
    
        // if (!$user) {
        //     // Si l'utilisateur n'est pas authentifié, renvoie une réponse 401 Unauthorized
        //     return response()->json(['message' => 'Non authentifié'], 401);
        // }
    
        // // Vérifie si l'utilisateur connecté est celui qui a créé l'annonce
        // if ($user->id !== $annonce->user_id) {
        //     dump($user->id);
        //     dump($annonce->user_id);
        //     // Si l'utilisateur n'a pas le droit de supprimer l'annonce
        //     return response()->json(['message' => 'Non autorisé'], 403);
        // }
    
        // // Si l'utilisateur est autorisé, supprimer l'annonce
        $this->authorize('delete',$annonce);
        $annonce->delete();
    
        return response()->json(['message' => 'Annonce supprimée avec succès'], 200);
    }
    



   
    
    public function getCandidaturesByAnnonce($annonceId, Request $request)
    {

        $annonce = $this->AnnonceService->getCandidaturesByAnnonce($annonceId,$request);


        return response()->json(['candidatures' => $annonce]);
    }
}
