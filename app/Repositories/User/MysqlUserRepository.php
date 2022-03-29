<?php

namespace App\Repositories\User;

use App\Database;
use App\Models\User;

class MysqlUserRepository implements UserRepository {

    public function save(User $user)
    {
        Database::connection()
            ->insert('unknown', [
                'name' => $user->getName(),
                'surname' => $user->getSurname()
            ]);
    }
}