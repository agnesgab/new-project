<?php

namespace App\Repositories\Product;

use App\Database;
use App\Models\Product;

class MysqlProductRepository implements ProductRepository {

    public function save(Product $product)
    {
        Database::connection()
            ->insert('products', [
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'amount' => $product->getAmount(),
                'description' => $product->getDescription()
            ]);
    }

    public function show(int $id): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery()
            ->fetchAssociative();
    }

    public function index(): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->executeQuery()
            ->fetchAllAssociative();

    }
}