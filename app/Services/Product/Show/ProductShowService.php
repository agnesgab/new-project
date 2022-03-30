<?php

namespace App\Services\Product\Show;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class ProductShowService {

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository){

        $this->productRepository = $productRepository;
    }

    public function execute(ProductShowRequest $request): ProductShowResponse
    {
        $productQuery = $this->productRepository->show($request->getProductId());

        $product = new Product($productQuery['name'], $productQuery['description'],
            $productQuery['price'], $productQuery['amount'], $productQuery['id']);

        return new ProductShowResponse($product);

    }

}