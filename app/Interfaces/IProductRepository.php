<?php

namespace App\Interfaces;

interface IProductRepository
{
    public function getAll($params);
    public function getOne($id);
    public function Store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}
