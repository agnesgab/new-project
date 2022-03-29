<?php

namespace App\Services\User\Save;

use App\Database;
use App\Models\User;
use App\Repositories\User\MysqlUserRepository;
use App\Repositories\User\UserRepository;

class UserSaveService {

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new MysqlUserRepository();
    }

    public function execute(UserSaveRequest $request){

        $user = new User($request->getName(), $request->getSurname());
        $this->userRepository->save($user);

    }

}