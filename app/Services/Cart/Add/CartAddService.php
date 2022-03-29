<?php

namespace App\Services\Cart\Add;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\MysqlCartRepository;

class CartAddService {

    private CartRepository $cartRepository;

    public function __construct()
    {
        $this->cartRepository = new MysqlCartRepository();
    }

    public function execute(CartAddRequest $request){

        $this->cartRepository->add($request->getUserId(), $request->getProductId(), $request->getAmount());

    }
}