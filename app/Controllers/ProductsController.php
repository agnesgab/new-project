<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Product\Index\ProductIndexRequest;
use App\Services\Product\Index\ProductIndexService;
use App\Services\Product\Save\ProductSaveRequest;
use App\Services\Product\Save\ProductSaveService;
use App\Services\Product\Show\ProductShowRequest;
use App\Services\Product\Show\ProductShowService;
use App\View;
use Psr\Container\ContainerInterface;

class ProductsController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function index()
    {
        $request = new ProductIndexRequest();
        $service = $this->container->get(ProductIndexService::class);
        $response = $service->execute($request);

        $products = $response->getProducts();

        return new View('Products/index.html', ['products' => $products]);
    }

    public function show(array $vars)
    {
        $productId = (int)$vars['id'];
        $request = new ProductShowRequest($productId);
        $service = $this->container->get(ProductShowService::class);
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
        $service = $this->container->get(ProductSaveService::class);
        $service->execute($request);

        return new Redirect('/products');
    }




}