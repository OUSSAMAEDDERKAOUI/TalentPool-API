<?php

namespace App\Services;

use App\Models\Candidature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\CandidatureRepository;
use Illuminate\Support\Facades\Notification;
use App\Mail\CandidatureStatusUpdate;

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
    public function updateCandidature(array $candidatureData, Candidature $candidature)
{
    $candidature = $this->CandidatureRepository->updateCandidature($candidatureData, $candidature);

    if (isset($candidatureData['status'])) {
        // dump($candidatureData['status']);
        // Mail::send($candidature->user, new CandidatureStatusUpdate($candidature));
        Mail::to($candidature->user)->send(new CandidatureStatusUpdate($candidature));

    }

    return $candidature;
}


        public function showAllCandidature(){
            $candidatures=$this->CandidatureRepository->showAllCandidatures();
            return $candidatures;
        }
        // public function updateStatus(array $CandidatureData , Candidature $Candidature)
        // {
        //     $candidature = $this->CandidatureRepository->updateStatus($CandidatureData,$Candidature);
           
        //     // Notification
        //     // Notification::send($candidature->user, new CandidatureStatusUpdate($candidature));

        //     return $candidature;
        // }
}

