<?php

namespace App\Http\Controllers;

use App\Models\CampBenefit;
use App\Repositories\CampBenefitRepository;
use App\Repositories\CampRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $campRepository;
    private $campBenefitRepository;
    
    public function __construct(
        CampRepository $campRepository,
        CampBenefitRepository $campBenefitRepository
    )
    {
       $this->campRepository = $campRepository;
       $this->campBenefitRepository = $campBenefitRepository;
    }

    public function index()
    {
        $camps = $this->campRepository->get([
            'with' => ['campBenefits'],
        ]);

   
        return view('index', [
            'camps' => $camps,
        ]);
    }
}
