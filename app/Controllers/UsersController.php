<?php

namespace App\Controllers;

use App\Redirect;
use App\View;

class UsersController {

    public function hello(){
        return new View('User/hello.html');
    }


}