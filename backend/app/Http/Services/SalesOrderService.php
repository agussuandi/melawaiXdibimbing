<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\TrxHSalesOrder;
use App\Models\TrxDSalesOrder;
use App\Helpers\UniqueCodeHelper;
use App\Exceptions\CustomException;
use App\Http\Resources\SalesOrderResource;

class SalesOrderService
{
    public function index($request)
    {
        try
        {
            $salesOrders = TrxHSalesOrder::paginate($request->get('limit', 10))->withQueryString();

            return SalesOrderResource::collection($salesOrders);
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store($request)
    {
        try
        {
            User::insert([
                'name'              => $request->input('userName'),
                'username'          => Str::of($request->input('userName'))->snake(),
                'email'             => $request->input('userEmail'),
                'email_verified_at' => now(),
                'password'          => bcrypt($request->input('userPassword')),
                'remember_token'    => Str::random(10),
                'created_at'        => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'User added'
            ]);
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try
        {
            $salesOrder = TrxHSalesOrder::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => new SalesOrderResource($salesOrder)
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Sales order not found');
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update($request, $id)
    {
        try
        {
            User::findOrFail($id)->update([
                'name'       => $request->input('userName'),
                'email'      => $request->input('userEmail'),
                'password'   => bcrypt($request->input('userPassword')),
                'updated_at' => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'User updated'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('User not found');
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try
        {
            User::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'data'   => 'User deleted'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('User not found');
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}