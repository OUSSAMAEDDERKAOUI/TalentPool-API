<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class AnnonceController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {


    }

    
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validation des données de la requête
        $validatedData = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:1000',
        ]);
    
        // Création de la nouvelle annonce avec l'ID de l'utilisateur authentifié
        $annonce = Annonce::create([
            'user_id' => Auth::user()->id, // Utilisation d'Auth::user()->id pour récupérer l'ID de l'utilisateur authentifié
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
    
        // Retourner la réponse JSON avec un message de succès et l'annonce créée
        return response()->json([
            'status' => "L'annonce a été ajoutée avec succès.",
            'annonce' => $annonce,
        ], 201); // Code HTTP 201 pour indiquer que l'annonce a été créée
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Annonce $Annonce)
    {
        //
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
