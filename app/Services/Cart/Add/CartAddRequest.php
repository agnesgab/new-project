<?php

namespace App\Services\Cart\Add;

class CartAddRequest {

    private int $productId;
    private int $userId;
    private int $amount;

    public function __construct(int $productId, int $userId, int $amount)
    {

        $this->productId = $productId;
        $this->userId = $userId;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}