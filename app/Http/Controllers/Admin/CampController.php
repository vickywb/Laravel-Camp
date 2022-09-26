<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampStoreRequest;
use App\Models\Camp;
use App\Repositories\CampRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CampController extends Controller
{
    private $campRepository;

    public function __construct(CampRepository $campRepository)
    {
        $this->campRepository = $campRepository;    
    }

    public function index()
    {
        $camps = $this->campRepository->get([
            'pagination' => 5
        ]);

        return view('admin.camps.index', [
            'camps' => $camps
        ]);
    }

    public function create()
    {
        $camp = new Camp();
        
        return view('admin.camps.create', [
            'camp' => $camp
        ]);
        
    }

    public function store(Request $request, Camp $camp)
    {   
        $price = $request->price * 1000;

        $request->merge([
            'slug' => Str::slug($request->title), '-',
            'price' => $price
        ]);

        $data = $request->only([
            'title', 'price', 'slug'
        ]);

        try {
            DB::beginTransaction();

            $camp = new Camp($data);
            $camp = $this->campRepository->store($camp);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.camp.index')->with([
            'success' => 'New Camp has been created.' 
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Camp $camp)
    {
        return view('admin.camps.edit', [
            'camp' => $camp
        ]);
    }

    public function update(CampStoreRequest $request, Camp $camp)
    {   
        $price = $request->price * 1000;

        $request->merge([
            'slug' => Str::slug($request->title), '-',
            'price' => $price
        ]);

        $data = $request->only([
            'title', 'slug', 'price'
        ]);

        try {
            DB::beginTransaction();

            $camp = $camp->fill($data);
            $camp = $this->campRepository->store($camp);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }
        
        return redirect()->route('admin.camp.index')->with([
            'success' => 'Camp has been updated.'
        ]);
    }

    public function destroy(Camp $camp)
    {
        try {
            DB::beginTransaction();

            $camp->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.camp.index')->with([
            'success' => 'This Camp successfully deleted.'
        ]);
    }
}
