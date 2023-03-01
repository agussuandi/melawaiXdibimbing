<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\CustomersRequest;
use App\Http\Services\CustomersService;

class CustomersController extends Controller
{
    public function __construct(
        private CustomersService $customersService
    )
    {
        $this->customersService = $customersService;
    }

    /**
     * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        return $this->customersService->index($request);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(CustomersRequest $request)
    {
        return $this->customersService->store($request);
    }

    /**
     * Display the specified resource.
    */
    public function show(string $id)
    {
        return $this->customersService->show($id);
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(CustomersRequest $request, string $id)
    {
        return $this->customersService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        return $this->customersService->destroy($id);
    }
}
