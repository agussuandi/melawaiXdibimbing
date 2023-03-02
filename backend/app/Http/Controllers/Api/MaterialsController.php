<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\MaterialsRequest;
use App\Http\Services\MaterialsService;

class MaterialsController extends Controller
{
    public function __construct(
        private MaterialsService $materialsService
    )
    {
        $this->materialsService = $materialsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->materialsService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialsRequest $request)
    {
        return $this->materialsService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->materialsService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialsRequest $request, string $id)
    {
        return $this->materialsService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->materialsService->destroy($id);
    }
}
