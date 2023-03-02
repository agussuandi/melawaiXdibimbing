<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\CustomerReceiptsRequest;
use App\Http\Services\CustomerReceiptsService;

class CustomerReceiptsController extends Controller
{
    public function __construct(
        private CustomerReceiptsService $customerReceiptsService
    )
    {
        $this->customerReceiptsService = $customerReceiptsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->customerReceiptsService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerReceiptsRequest $request)
    {
        return $this->customerReceiptsService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->customerReceiptsService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerReceiptsRequest $request, string $id)
    {
        return $this->customerReceiptsService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->customerReceiptsService->destroy($id);
    }
}
