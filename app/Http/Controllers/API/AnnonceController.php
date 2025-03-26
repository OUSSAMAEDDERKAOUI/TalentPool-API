<?php

namespace App\Http\Controllers\API;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Services\AnnonceService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestAnnonce;
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
$annonces=DB::table("annonces")->get();
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
        $validatedData = $request->validated();
    // dump($validatedData);
    
        $annonce = $this->AnnonceService->registerAnnonce($validatedData);

        return response()->json([
            'status' => "L'annonce a été ajoutée avec succès.",
            'annonce' => $annonce,
        ], 201); 
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Annonce $Annonce)
    {

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
    public function update(Request $request, Annonce $Annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $Annonce)
    {
        //
    }
}
