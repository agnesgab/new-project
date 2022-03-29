<?php

namespace App\Services\Cart\Show;

class CartShowRequest {

    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}