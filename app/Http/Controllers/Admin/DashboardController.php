<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CheckoutRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    private $checkoutRepository;

    public function __construct(CheckoutRepository $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
    }

    public function index()
    {   
        $checkouts = $this->checkoutRepository->get([
            'with' => ['camp'],
            'pagination' => 5
        ]);

        // dd($checkouts);
        return view('admin.dashboard', [
            'checkouts' => $checkouts
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
