<?php

namespace App\Controllers;

use App\Database;
use App\Models\Cart;
use App\Models\Product;
use App\Redirect;
use App\Services\Product\Save\ProductSaveRequest;
use App\Services\Product\Save\ProductSaveService;
use App\Services\Product\Show\ProductShowRequest;
use App\Services\Product\Show\ProductShowService;
use App\View;

class ProductsController
{
    public function index()
    {
        $productsQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->executeQuery()
            ->fetchAllAssociative();

        $products = [];
        foreach ($productsQuery as $product) {
            $products[] = new Product(
                $product['name'], $product['description'], $product['price'], $product['amount'], $product['id']
            );
        }
        return new View('Products/index.html', ['products' => $products]);
    }

    public function show(array $vars)
    {
        $productId = (int)$vars['id'];
        $request = new ProductShowRequest($productId);
        $service = new ProductShowService();
        $response = $service->execute($request);

        $product = $response->getProduct();

        return new View('Products/show.html', ['product' => $product]);

    }


    public function addProduct(): View
    {
        return new View('Products/add.html');
    }

    public function storeProduct(): Redirect
    {
        $request = new ProductSaveRequest($_POST['name'], $_POST['price'], $_POST['amount'], $_POST['description']);
        $service = new ProductSaveService();
        $service->execute($request);

        return new Redirect('/products');
    }




}