<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Models\CampBenefit;
use App\Repositories\CampBenefitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampBenefitController extends Controller
{
    private $campBenefitRepository;

    public function __construct(CampBenefitRepository $campBenefitRepository)
    {
        $this->campBenefitRepository = $campBenefitRepository;
    }
    public function index()
    {   
        $campBenefits = $this->campBenefitRepository->get([
            'pagination' => 5
        ]);

        return view('admin.campbenefits.index', [
            'campBenefits' => $campBenefits
        ]);
    }

    public function create()
    {
        $campBenefit = new CampBenefit();
        $camps = Camp::all();

        return view('admin.campbenefits.create', [
            'campBenefit' => $campBenefit,
            'camps' => $camps
        ]);
    }

    public function store(Request $request, CampBenefit $campBenefit)
    {
        $data = $request->only([
            'camp_id', 'name'
        ]);

        try {
            DB::beginTransaction();

            $campBenefit = new CampBenefit($data);
            $campBenefit = $this->campBenefitRepository->store($campBenefit);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.camp-benefit.index')->with([
            'success' => 'Camp Benefit has been created.'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit(CampBenefit $campBenefit)
    {
        $camps = Camp::all();

        return view('admin.campbenefits.edit', [
            'campBenefit' => $campBenefit,
            'camps' => $camps
        ]);
    }

    public function update(Request $request, CampBenefit $campBenefit)
    {
        //
    }

    public function destroy(CampBenefit $campBenefit)
    {
        //
    }
}
