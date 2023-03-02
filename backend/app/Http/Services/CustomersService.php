<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\MCustomers;
use App\Helpers\UniqueCodeHelper;
use App\Exceptions\CustomException;
use App\Http\Resources\CustomersResource;

class CustomersService
{
    public function index($request)
    {
        try
        {
            // $customers = MCustomers::paginate($request->get('limit', 10))->withQueryString();
            $customers = MCustomers::all();

            return CustomersResource::collection($customers);
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
            $customer = MCustomers::insert([
                'code'         => UniqueCodeHelper::generateCustomerCode(),
                'name'         => $request->input('customerName'),
                'birth_date'   => $request->input('customerBirthDate'),
                'address'      => $request->input('customerAddress'),
                'city'         => $request->input('customerCity'),
                'no_handphone' => $request->input('customerNoHandphone'),
                'email'        => $request->input('customerEmail'),
                'created_at'   => now()
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Customer added'
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
            $customer = MCustomers::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => new CustomersResource($customer)
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer not found');
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
            MCustomers::findOrFail($id)->update([
                'name'         => $request->input('customerName'),
                'birth_date'   => $request->input('customerBirthDate'),
                'address'      => $request->input('customerAddress'),
                'city'         => $request->input('customerCity'),
                'no_handphone' => $request->input('customerNoHandphone'),
                'email'        => $request->input('customerEmail'),
                'updated_at'   => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Customer updated'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer not found');
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
            MCustomers::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'data'   => 'Customer deleted'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer not found');
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