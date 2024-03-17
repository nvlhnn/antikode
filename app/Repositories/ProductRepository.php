<?php

namespace App\Repositories;

use App\Interfaces\IProductRepository;
use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function getAll($params)
    {
        $query = Product::with('brand');

        if ($params->brand_id) {
            $query->where('brand_id', $params->brand_id);
        }

        return $query->simplePaginate($params['limit'] ?? 10);
    }

    public function getOne($id)
    {
        return Product::with('brand')->find($id);
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        return Product::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Product::find($id)->delete();
    }
}
