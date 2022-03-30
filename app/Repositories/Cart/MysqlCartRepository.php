<?php

namespace App\Repositories\Cart;

use App\Database;

class MysqlCartRepository implements CartRepository {

    public function add(int $userId, int $productId, int $amount)
    {
        $price = Database::connection()
            ->createQueryBuilder()
            ->select('price')
            ->from('products')
            ->where('id = ?')
            ->setParameter(0, $productId)
            ->executeQuery()
            ->fetchOne();

        $totalPrice = $amount * $price;

        Database::connection()
            ->insert('carts', ['user_id' => $userId, 'product_id' => $productId, 'total_amount' => $amount, 'total_price' => $totalPrice]);
    }

    public function remove(int $itemId)
    {
        Database::connection()
            ->delete('carts', ['item_id' => $itemId]);
    }

    public function show(int $userId): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('carts', 'c')
            ->innerJoin('c', 'products', 'p',
                'c.product_id = p.id')
            ->where('user_id = ?')
            ->setParameter(0, $userId)
            ->executeQuery()
            ->fetchAllAssociative();
    }
}