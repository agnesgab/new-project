<?php

namespace App\Services\Cart\Show;

class CartShowResponse
{
    private array $products;
    private int $totalSum;

    public function __construct(array $products, int $totalSum)
    {
        $this->products = $products;
        $this->totalSum = $totalSum;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getTotalSum(): int
    {
        return $this->totalSum;
    }
}