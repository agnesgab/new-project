<?php

namespace App\Services\Product\Show;

class ProductShowRequest{

    private int $productId;

    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }
}