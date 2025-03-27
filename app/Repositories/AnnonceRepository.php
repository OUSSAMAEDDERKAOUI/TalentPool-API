<?php
namespace App\Repositories;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Candidature;
use Illuminate\Support\Facades\DB;



class AnnonceRepository{

protected $AnnonceModel;


public function __construct(Annonce $AnnonceModel){
    $this->AnnonceModel=$AnnonceModel;
}

    public function  createAnnonce(array $annonceData){
        $annonce = Annonce::create([
            'user_id' => 1, 
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
        $annonces=DB::table("annonces")->get();
        return $annonces;

    }
 





}