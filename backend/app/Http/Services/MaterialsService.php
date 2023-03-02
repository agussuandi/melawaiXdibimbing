<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\MMaterials;
use App\Helpers\UniqueCodeHelper;
use App\Exceptions\CustomException;
use App\Http\Resources\MaterialsResource;

class MaterialsService
{
    public function index($request)
    {
        try
        {
            // $users = MMaterials::paginate($request->get('limit', 10))->withQueryString();

            $materials = MMaterials::all();

            return MaterialsResource::collection($materials);
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
            MMaterials::insert([
                'code'       => UniqueCodeHelper::generateMaterialCode(),
                'name'       => $request->input('materialName'),
                'price'      => $request->input('materialPrice'),
                'created_at' => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Material added'
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
            $material = MMaterials::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => new MaterialsResource($material)
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Material not found');
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
            MMaterials::findOrFail($id)->update([
                'name'       => $request->input('materialName'),
                'price'      => $request->input('materialPrice'),
                'updated_at' => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Material updated'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Material not found');
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
            MMaterials::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'data'   => 'Material deleted'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Material not found');
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