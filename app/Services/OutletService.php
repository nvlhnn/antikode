<?php

namespace App\Services;

use App\Helpers\FileHelper;
use App\Interfaces\IOutletRepository;

class OutletService
{
    protected $outletRepo;
    public function __construct(IOutletRepository $outletRepo)
    {
        $this->outletRepo = $outletRepo;
    }

    public function getAll($request)
    {
        return $this->outletRepo->getAll($request);
    }

    public function getOne($id)
    {
        return $this->outletRepo->getOne($id);
    }

    public function store($request)
    {

        $data = [
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'address' => $request->address,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ];

        if ($request->hasFile('picture')) {
            $data['picture'] = FileHelper::uploadFile($request->picture, "outlets");
        }

        return $this->outletRepo->store($data);
    }


    public function update($request, $id)
    {
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ];

        if ($request->hasFile('picture')) {
            $data['picture'] = FileHelper::uploadFile($request->picture, "outlets");
        }

        return $this->outletRepo->update($id, $data);
    }


    public function destroy($id)
    {
        $outlet = $this->outletRepo->getOne($id);

        if (!empty($outlet)) {
            if ($outlet->picture) {
                FileHelper::deleteFile('outlets', $outlet->picture);
            }
        }

        return $this->outletRepo->destroy($id);
    }
}
