<?php

namespace App\Services;

use App\Helpers\FileHelper;
use App\Interfaces\IBrandRepository;

class BrandService
{
    protected $brandRepo;
    public function __construct(IBrandRepository $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    public function getAll($request)
    {
        return $this->brandRepo->getAll($request);
    }

    public function getOne($id)
    {
        return $this->brandRepo->getOne($id);
    }

    public function store($request)
    {

        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = FileHelper::uploadFile($request->logo, "brands");
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = FileHelper::uploadFile($request->banner, "brands");
        }

        return $this->brandRepo->store($data);
    }


    public function update($request, $id)
    {
        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = FileHelper::uploadFile($request->logo, "brands");
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = FileHelper::uploadFile($request->banner, "brands");
        }

        return $this->brandRepo->update($id, $data);
    }


    public function destroy($id)
    {
        $brand = $this->brandRepo->getOne($id);

        if (!empty($brand)) {
            if ($brand->logo) {
                FileHelper::deleteFile('brands', $brand->logo);
            }

            if ($brand->banner) {
                FileHelper::deleteFile('brands', $brand->banner);
            }
        }


        return $this->brandRepo->destroy($id);
    }
}
