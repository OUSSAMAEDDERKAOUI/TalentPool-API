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
    

    /**
     * Display the specified resource.
     */
    public function show(Candidature $Candidature)
    {

    return  response()->json([
               'Candidature' => $Candidature,
           ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidature $Candidature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidatureRequest $request, Candidature $Candidature)
    {
        // dump($request);

        $validatedData=$request->validated();
        // dd($validatedData);
        $Candidature = $this->CandidatureService->updateCandidature($validatedData,$Candidature);

        return  response()->json([
            'Candidature' => $Candidature,
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidature $Candidature)
    {
        $Candidature->delete();
        return response()->json(['message' => 'Candidature deleted successfully'], 200);
    }
}

