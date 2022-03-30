<?php

namespace App\Services\Cart\Remove;

use App\Repositories\Cart\CartRepository;

class CartRemoveService {

    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function execute(CartRemoveRequest $request)
    {
        $this->cartRepository->remove($request->getItemId());
    }
}