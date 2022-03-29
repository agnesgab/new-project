<?php

namespace App\Services\Cart\Remove;

class CartRemoveRequest {

    private int $itemId;

    public function __construct(int $itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return int
     */
    public function getItemId(): int
    {
        return $this->itemId;
    }
}