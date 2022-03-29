<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\User\Save\UserSaveRequest;
use App\Services\User\Save\UserSaveService;
use App\Services\User\Store\UserStoreService;
use App\View;

class UsersController {

    public function hello(){
        return new View('User/signup.html');
    }

    public function saveUser(){

        $request = new UserSaveRequest($_POST['name'], $_POST['surname']);
        $service = new UserSaveService();
        $service->execute($request);

        //return new View('Users/login.html');
    }


}