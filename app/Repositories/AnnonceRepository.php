<?php
namespace App\Repositories;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Candidature;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;




class AnnonceRepository{

protected $AnnonceModel;


public function __construct(Annonce $AnnonceModel){
    $this->AnnonceModel=$AnnonceModel;
}

    public function  createAnnonce(array $annonceData){
        $annonce = Annonce::create([
            'user_id' => auth()->id(), 
            'title' => $annonceData['title'],
            'description' => $annonceData['description'],
        ]);
        return $annonce;

    }

    public function  updateAnnonce(array $annonceData , Annonce $annonce){
        $annonce->update($annonceData);
        return $annonce;

    }

    public function showAllAnnonces(){
        $annonces=DB::table("annonces")->where('user_id',auth()->id())->get();
        return $annonces;

    }
    public function getCandidaturesByAnnonce($annonceId, Request $request)
    {
        $annonce = Annonce::find($annonceId);

        if (!$annonce) {
            return response()->json(['message' => 'Annonce non trouvée'], 404);
        }

        $query = $annonce->candidatures();

        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        $candidatures = $query->get();

        return $candidatures;
    }





}