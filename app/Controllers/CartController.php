<?php

namespace App\Controllers;

use App\Database;
use App\Models\Product;
use App\Redirect;
use App\Services\Cart\Add\CartAddRequest;
use App\Services\Cart\Add\CartAddService;
use App\Services\Cart\Remove\CartRemoveRequest;
use App\Services\Cart\Remove\CartRemoveService;
use App\Services\Cart\Show\CartShowRequest;
use App\Services\Cart\Show\CartShowService;
use App\View;

class CartController {

    public function addToCart(array $vars):Redirect
    {
        $productId = (int)$vars['id'];
        $userId = $_SESSION['id'];
        $amount = $_POST['amount'];

        $request = new CartAddRequest($productId, $userId, $amount);
        $service = new CartAddService();
        $service->execute($request);

        return new Redirect('/products');

    }

    public function showCart()
    {
        $userId = $_SESSION['id'];
        $request = new CartShowRequest($userId);
        $service = new CartShowService();
        $response = $service->execute($request);

        return new View('Cart/cart.html', ['products' => $response->getProducts(), 'total' => $response->getTotalSum()]);
    }

    public function removeFromCart(array $vars)
    {
        $itemId = (int)$vars['id'];
        $request = new CartRemoveRequest($itemId);
        $service = new CartRemoveService();
        $service->execute($request);

        return new Redirect('/cart');
    }
}