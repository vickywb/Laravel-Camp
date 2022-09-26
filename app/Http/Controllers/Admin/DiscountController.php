<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountStoreRequest;
use App\Http\Requests\DiscountUpdateRequest;
use App\Models\Discount;
use App\Repositories\DiscountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    private $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function index()
    {
        $discounts = $this->discountRepository->get([
            'pagination' => 5,
            'order' => 'created_at DESC'
        ]);

        return view('admin.discounts.index', [
            'discounts' => $discounts
        ]);
    }

    public function create()
    {
        $discount = new Discount();
        $typeMaps = Discount::TYPE_MAP;

        return view('admin.discounts.create', [
            'discount' => $discount,
            'typeMaps' => $typeMaps
        ]);
    }

    public function store(DiscountStoreRequest $request, Discount $discount)
    {   
        $request->merge([
            'amount' => (int) $request->amount
        ]);

        $data = $request->only([
            'title', 'code', 'type', 'amount'
        ]);

        try {
            DB::beginTransaction();

            $discount = new Discount($data);
            $discount = $this->discountRepository->store($discount);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.discount.index')->with([
            'success' => 'Discount has been created.'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Discount $discount)
    {
        $typeMaps = Discount::TYPE_MAP;

        return view('admin.discounts.edit', [
            'discount' => $discount,
            'typeMaps' => $typeMaps
        ]);
    }

    public function update(DiscountUpdateRequest $request, Discount $discount)
    {
        $request->merge([
            'amount' => (int) $request->amount
        ]);

        $data = $request->only([
            'title', 'code', 'type', 'amount'
        ]);
        
        try {
            DB::beginTransaction();

            $discount = $discount->fill($data);
            $discount = $this->discountRepository->store($discount);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.discount.index')->with([
            'success' => 'Discount has been updated.'
        ]);
    }

    public function destroy(Discount $discount)
    {
        try {
            DB::beginTransaction();

            $discount->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.discount.index')->with([
            'success' => 'Discount with id: ' . $discount->id . ' has been deleted.' 
        ]);
    }
}
