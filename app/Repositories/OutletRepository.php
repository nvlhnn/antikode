<?php

namespace App\Repositories;

use App\Interfaces\IOutletRepository;
use App\Models\Outlet;

class OutletRepository implements IOutletRepository
{
    public function getAll($params)
    {
        $query = Outlet::with('brand');

        if (!empty($params->brand_id)) {
            $query->where('brand_id', $params->brand_id);
        }

        if (!empty($params->order)) {
            $monas = [
                'latitude' => -6.1797752,
                'longitude' => 106.7937719
            ];

            $query->selectRaw('*, ( 6371 * acos( cos( radians(' . $monas['latitude'] . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $monas['longitude'] . ') ) + sin( radians(' . $monas['latitude'] . ') ) * sin( radians( latitude ) ) ) ) AS distance')
                ->orderBy('distance', 'asc');
        }

        return $query->simplePaginate($params['limit'] ?? 10);
    }

    public function getOne($id)
    {
        return Outlet::with('brand')->find($id);
    }

    public function store(array $data)
    {
        return Outlet::create($data);
    }

    public function update($id, array $data)
    {
        return Outlet::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Outlet::find($id)->delete();
    }
}
