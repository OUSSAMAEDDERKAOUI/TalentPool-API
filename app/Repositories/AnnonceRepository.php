<?php
namespace App\Repositories;
use App\Models\Annonce;
use App\Models\Candidature;
use App\Models\User;



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





}