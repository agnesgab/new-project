<?php

namespace App\Services\Product\Index;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class ProductIndexService {

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(){

        $productsQuery = $this->productRepository->index();

        $products = [];
        foreach ($productsQuery as $product) {
            $products[] = new Product(
                $product['name'], $product['description'], $product['price'], $product['amount'], $product['id']
            );
        }

        return new ProductIndexResponse($products);
    }
}