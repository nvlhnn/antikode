<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Services\OutletService;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    protected $outletSvc;
    public function __construct(OutletService $outletSvc)
    {
        $this->outletSvc = $outletSvc;
    }


    public function index(Request $request)
    {
        try {
            $data = $this->outletSvc->getAll($request);
            return response()->json(ResponseHelper::response(true, "Data retrieved successfully", $data), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function store(StoreOutletRequest $request)
    {
        try {
            $data = $this->outletSvc->store($request);

            return response()->json(ResponseHelper::response(true, "Data stored successfully", $data), 201);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function show($id)
    {
        try {
            $data = $this->outletSvc->getOne($id);

            if (!$data) {
                return response()->json(ResponseHelper::response(false, "Data not found"), 404);
            }

            return response()->json(ResponseHelper::response(true, "Data retrieved successfully", $data), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }


    public function update(UpdateOutletRequest $request, $id)
    {
        try {
            $data = $this->outletSvc->update($request, $id);
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
            $data = $this->outletSvc->destroy($id);
            return response()->json(ResponseHelper::response(true, "Data deleted successfully", null), 200);
        } catch (\Throwable $th) {
            return response()->json(ResponseHelper::response(false, $th->getMessage()));
        }
    }
}
