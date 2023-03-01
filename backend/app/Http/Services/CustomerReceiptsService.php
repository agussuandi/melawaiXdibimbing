<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

use App\Models\MCustomerReceipts;
use App\Helpers\UniqueCodeHelper;
use App\Http\Resources\CustomerReceiptsResource;

class CustomerReceiptsService
{
    public function index($request)
    {
        try
        {
            // $customerReceipts = MCustomerReceipts::with('customer')
            //     ->paginate($request->get('limit', 10))
            // ->withQueryString();

            $customerReceipts = MCustomerReceipts::with('customer')->get();

            return CustomerReceiptsResource::collection($customerReceipts);
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
            MCustomerReceipts::insert([
                'code'           => UniqueCodeHelper::generateReceiptCode(),
                'name'           => $request->input('customerReceiptName'),
                'customer_id'    => $request->input('customerId'),
                'spheris_right'  => $request->input('customerReceiptSpherisRight'),
                'spheris_left'   => $request->input('customerReceiptSpherisLeft'),
                'cylinder_right' => $request->input('customerReceiptCylinderRight'),
                'cylinder_left'  => $request->input('customerReceiptCylinderLeft'),
                'addition_right' => $request->input('customerReceiptAdditionRight'),
                'addition_left'  => $request->input('customerReceiptAdditionLeft'),
                'axis_right'     => $request->input('customerReceiptAxisRight'),
                'axis_left'      => $request->input('customerReceiptAxisLeft'),
                'created_at'     => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Customer Receipt added'
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
            $customerReceipt = MCustomerReceipts::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => new CustomerReceiptsResource($customerReceipt)
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

    public function update($request, $id)
    {
        try
        {
            MCustomerReceipts::findOrFail($id)->update([
                'name'           => $request->input('customerReceiptName'),
                'customer_id'    => $request->input('customerId'),
                'spheris_right'  => $request->input('customerReceiptSpherisRight'),
                'spheris_left'   => $request->input('customerReceiptSpherisLeft'),
                'cylinder_right' => $request->input('customerReceiptCylinderRight'),
                'cylinder_left'  => $request->input('customerReceiptCylinderLeft'),
                'addition_right' => $request->input('customerReceiptAdditionRight'),
                'addition_left'  => $request->input('customerReceiptAdditionLeft'),
                'axis_right'     => $request->input('customerReceiptAxisRight'),
                'axis_left'      => $request->input('customerReceiptAxisLeft'),
                'updated_at'     => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Customer Receipt updated'
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

    public function destroy($id)
    {
        try
        {
            MCustomerReceipts::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'data'   => 'Customer Receipt deleted'
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
}