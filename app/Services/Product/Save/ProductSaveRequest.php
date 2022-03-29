<?php

namespace App\Services\Product\Save;

class ProductSaveRequest {

    private string $name;
    private int $price;
    private int $amount;
    private string $description;

    public function __construct(string $name, int $price, int $amount, string $description)
    {
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}