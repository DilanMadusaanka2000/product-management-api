<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::all();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function find(int $id)
    {
        return Product::find($id);
    }

    public function update(int $id, array $data)
    {
        $product = $this->find($id);
        if ($product) {
            $product->update($data);
        }
        return $product;
    }

    public function delete(int $id)
    {
        $product = $this->find($id);
        if ($product) {
            $product->delete();
        }
        return $product;
    }
}
