<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\UsersRequest;
use App\Http\Services\UsersService;

class UsersController extends Controller
{
    public function __construct(
        private UsersService $usersService
    )
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        return $this->usersService->index($request);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(UsersRequest $request)
    {
        return $this->usersService->store($request);
    }

    /**
     * Display the specified resource.
    */
    public function show(string $id)
    {
        return $this->usersService->show($id);
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(UsersRequest $request, string $id)
    {
        return $this->usersService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        return $this->usersService->destroy($id);
    }
}
