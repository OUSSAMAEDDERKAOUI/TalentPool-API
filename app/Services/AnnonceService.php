<?php
namespace App\Services;
use App\Models\Annonce;
use App\Models\User;
use App\Repositories\AnnonceRepository;
use PhpParser\Builder\Function_;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use Illuminate\Http\Request;

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
public function showAllAnnonces(){
    $annonces=$this->annonceRepository->showAllAnnonces();
    return $annonces;
}


public function index(){
    $annonces=$this->annonceRepository->index();
    return $annonces;
}


public function updateAnnonce(array $annonceData , Annonce $annonce){
    $annonce=$this->annonceRepository->updateAnnonce($annonceData,$annonce);
    return $annonce;
        
    }
    public function getCandidaturesByAnnonce($annonceId, Request $request){
        $annonce=$this->annonceRepository->getCandidaturesByAnnonce($annonceId,$request);
        return $annonce;
            
        }
}