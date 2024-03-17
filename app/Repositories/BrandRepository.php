<?php

namespace App\Repositories;

use App\Interfaces\IBrandRepository;
use App\Models\Brand;

class BrandRepository implements IBrandRepository
{

    public function getAll($params)
    {
        return Brand::withCount(['outlets', 'products'])->simplePaginate($params['limit'] ?? 10);
    }

    public function getOne($id)
    {
        return Brand::with('outlets', 'products')->find($id);
    }

    public function Store(array $data)
    {
        return Brand::create($data);
    }

    public function update($id, array $data)
    {
        return Brand::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Brand::destroy($id);
    }
}
