<?php

namespace App\Services\Product\Save;

use App\Models\Product;
use App\Repositories\Product\MysqlProductRepository;
use App\Repositories\Product\ProductRepository;

class ProductSaveService {

    private ProductRepository $productRepository;

    public function __construct(){

        $this->productRepository = new MysqlProductRepository();
    }

    public function execute(ProductSaveRequest $request){

        $product = new Product($request->getName(), $request->getDescription(), $request->getPrice(), $request->getAmount());

        $this->productRepository->save($product);

        return $product;
    }
}