<?php

namespace App\Repositories\Cart;

use App\Models\Product;

interface CartRepository {

    public function add(int $userId, int $productId, int $amount);
    public function remove(int $itemId);
    public function show(int $userId);
}