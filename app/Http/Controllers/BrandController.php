<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandSvc;
    public function __construct(BrandService $brandSvc)
    {
        $this->brandSvc = $brandSvc;
    }


    public function index()
    {
        try {
            $data = $this->brandSvc->getAll(request()->all());

            return response()->json(ResponseHelper::response(true, "Data retrieved successfully", $data), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function store(StoreBrandRequest $request)
    {
        try {
            $data = $this->brandSvc->store($request);

            return response()->json(ResponseHelper::response(true, "Data stored successfully", $data), 201);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function show($id)
    {
        try {
            $data = $this->brandSvc->getOne($id);

            if (!$data) {
                return response()->json(ResponseHelper::response(false, "Data not found"), 404);
            }

            return response()->json(ResponseHelper::response(true, "Data retrieved successfully", $data), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function update(UpdateBrandRequest $request, $id)
    {
        try {
            $data = $this->brandSvc->update($request, $id);
            if (!$data) {
                return response()->json(ResponseHelper::response(false, "Data not found"), 404);
            }

            return response()->json(ResponseHelper::response(true, "Data updated successfully", null), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function destroy($id)
    {
        try {
            $this->brandSvc->destroy($id);
            
            return response()->json(ResponseHelper::response(true, "Data deleted successfully", null), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }
}
