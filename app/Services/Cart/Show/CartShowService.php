<?php

namespace App\Services\Cart\Show;

use App\Models\Product;
use App\Repositories\Cart\CartRepository;

class CartShowService {

    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function execute(CartShowRequest $request): CartShowResponse
    {
        $cartQuery = $this->cartRepository->show($request->getUserId());

        $products = [];
        $totalSum = 0;
        foreach ($cartQuery as $data) {
            $products[] = new Product(
                $data['name'], $data['description'], $data['price'], $data['total_amount'], $data['item_id']
            );
            $totalSum += $data['total_price'];
        }

        return new CartShowResponse($products, $totalSum);

    }
}