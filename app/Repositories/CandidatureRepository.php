<?php
namespace App\Repositories;
use App\Models\User;
use App\Models\Candidat;
use App\Models\Candidature;
use Illuminate\Support\Facades\DB;



class CandidatureRepository{

protected $CandidatureModel;


public function __construct(Candidature $CandidatureModel){
    $this->CandidatureModel=$CandidatureModel;
}

    public function  createcandidature(array $CandidatureData){
        if (isset($CandidatureData['cv'])) {
            $CandidatureData['cv'] = $CandidatureData['cv']->store('cv_candidature', 'public');
        }
        $Candidature = Candidature::create([
            'user_id' => 3, 
            'cv' => $CandidatureData['cv'],
            'lettre_motivation' => $CandidatureData['lettre_motivation'],
            'annonce_id' => $CandidatureData['annonce_id'],

        ]);
        return $Candidature;

    }

    public function  updateCandidature(array $CandidatureData , Candidature $Candidature){
        
        $Candidature->update($CandidatureData);
        return $Candidature;

    }

    public function showAllCandidatures(){
        $Candidatures=DB::table("candidatures")->get();
        return $Candidatures;

    }
    public function  updateStatus(array $CandidatureData , Candidature $Candidature){
        
        $Candidature->update($CandidatureData);
        return $Candidature;

    }
 





}