<?php

namespace App\Services\Cart\Remove;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\MysqlCartRepository;

class CartRemoveService {

    private CartRepository $cartRepository;

    public function __construct()
    {
        $this->cartRepository = new MysqlCartRepository();
    }


    public function execute(CartRemoveRequest $request){

        $this->cartRepository->remove($request->getItemId());

    }
}