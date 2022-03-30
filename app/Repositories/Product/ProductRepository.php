<?php

namespace App\Repositories\Product;

use App\Models\Product;

interface ProductRepository {
    public function save(Product $product);
    public function show(int $id);
    public function index();
}