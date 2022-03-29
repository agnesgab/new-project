<?php

namespace App\Services\Product\Show;

use App\Models\Product;

class ProductShowResponse {

    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }







}