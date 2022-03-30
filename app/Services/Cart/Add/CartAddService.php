<?php

namespace App\Services\Cart\Add;

use App\Repositories\Cart\CartRepository;

class CartAddService {

    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }


    public function execute(CartAddRequest $request)
    {
        $this->cartRepository->add($request->getUserId(), $request->getProductId(), $request->getAmount());
    }
}