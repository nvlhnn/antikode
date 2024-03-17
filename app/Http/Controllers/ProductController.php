<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productSvc;
    public function __construct(ProductService $productSvc)
    {
        $this->productSvc = $productSvc;
    }


    public function index(Request $request)
    {
        try {
            $data = $this->productSvc->getAll($request);
            return response()->json(ResponseHelper::response(true, "Data retrieved successfully", $data), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function store(StoreProductRequest $request)
    {
        try {
            $data = $this->productSvc->store($request);

            return response()->json(ResponseHelper::response(true, "Data stored successfully", $data), 201);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function show($id)
    {
        try {
            $data = $this->productSvc->getOne($id);

            if (!$data) {
                return response()->json(ResponseHelper::response(false, "Data not found"), 404);
            }

            return response()->json(ResponseHelper::response(true, "Data retrieved successfully", $data), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $data = $this->productSvc->update($request, $id);
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
            $data = $this->productSvc->destroy($id);
            return response()->json(ResponseHelper::response(true, "Data deleted successfully", null), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }
}
