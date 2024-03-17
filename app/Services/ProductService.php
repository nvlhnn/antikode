<?php

namespace App\Services;

use App\Helpers\FileHelper;
use App\Interfaces\IProductRepository;

class productservice
{
    protected $productRepo;
    public function __construct(IProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getAll($request)
    {
        $data = $this->productRepo->getAll($request);
        return $data;
    }

    public function getOne($id)
    {
        $data = $this->productRepo->getOne($id);
        return $data;
    }

    public function store($request)
    {

        $data = [
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
        ];

        if ($request->hasFile('picture')) {
            $data['picture'] = FileHelper::uploadFile($request->picture, "products");
        }

        return $this->productRepo->store($data);
    }


    public function update($request, $id)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
        ];

        if ($request->hasFile('picture')) {
            $data['picture'] = FileHelper::uploadFile($request->picture, "products");
        }

        return $this->productRepo->update($id, $data);
    }


    public function destroy($id)
    {
        $product = $this->productRepo->getOne($id);

        if (!empty($product)) {
            if ($product->picture) {
                FileHelper::deleteFile('products', $product->picture);
            }
        }

        return $this->productRepo->destroy($id);
    }
}
