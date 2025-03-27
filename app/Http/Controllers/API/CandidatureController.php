<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Candidature;
use Illuminate\Http\Request;
use App\Http\Requests\Candidature\StoreCandidatureRequest;
use App\Http\Requests\Candidature\UpdateCandidatureRequest;

use App\Services\CandidatureService;
class CandidatureController extends Controller
{
    protected $CandidatureService;

    public function __construct(CandidatureService $CandidatureService)
    {
        $this->CandidatureService = $CandidatureService;
    }

 /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Candidature=$this->CandidatureService->showAllCandidature();
        return response()->json([
         'status'=>"l'affichage de toutes les Candidature",
         'Candidature'=>$Candidature,
]);

    }

    
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreCandidatureRequest $request)
    {
        $validatedData = $request->validated();
    
        $Candidature = $this->CandidatureService->registerCandidature($validatedData);

        return response()->json([
            'status' => "La Candidature a été ajoutée avec succès.",
            'Candidature' => $Candidature,
        ], 201); 
    }
    


