<?php

namespace App\Services\Product\Save;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class ProductSaveService {

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository){

        $this->productRepository = $productRepository;
    }

    public function execute(ProductSaveRequest $request): Product
    {

        $product = new Product($request->getName(), $request->getDescription(), $request->getPrice(), $request->getAmount());

        $this->productRepository->save($product);

        return $product;
    }
}