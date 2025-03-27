<?php

namespace App\Services;

use App\Models\Candidature;
use App\Repositories\CandidatureRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CandidatureService
{
    protected $CandidatureRepository;

    public function __construct(CandidatureRepository $CandidatRepository)
    {
        $this->CandidatureRepository = $CandidatRepository;
    }

    public function registercandidature(array $candidatureData)
    {
            
            
            $candidature = $this->CandidatureRepository->createcandidature($candidatureData);


            return $candidature;

    }
    public function updateCandidature(array $candidatureData , Candidature $Candidature){
        $Candidature=$this->CandidatureRepository->updateCandidature($candidatureData,$Candidature);
        return $Candidature;
            
        }

        public function showAllCandidature(){
            $condidatures=$this->CandidatureRepository->showAllCandidatures();
            return $condidatures;
        }
  
}

