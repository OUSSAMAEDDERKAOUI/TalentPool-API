<?php
namespace App\Services;
use App\Models\Annonce;
use App\Models\User;
use App\Repositories\AnnonceRepository;

class AnnonceService{

    protected $annonceRepository;

    public function __construct(AnnonceRepository $AnnonceRepository)
    {
        $this->annonceRepository=$AnnonceRepository;
    }

public function registerAnnonce(array $annonceData){
$annonce=$this->annonceRepository->createAnnonce($annonceData);
return $annonce;
    
}



}