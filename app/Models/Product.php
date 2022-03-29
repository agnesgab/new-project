<?php

namespace App\Models;

class Product {

    private string $name;
    private string $description;
    private float $price;
    private int $amount;
    private ?int $id;

    public function __construct(string $name, string $description, float $price, int $amount, ?int $id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->amount = $amount;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
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
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}