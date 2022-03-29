<?php

use App\Redirect;
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/user', ['App\Controllers\UsersController', 'hello']);

    $r->addRoute('GET', '/select', ['App\Controllers\UsersController', 'select']);

    //nothing going on
    $r->addRoute('GET', '/users', ['App\Controllers\UsersController', 'index']);
    $r->addRoute('GET', '/users/id', ['App\Controllers\UsersController', 'show']);

    //reservation
    $r->addRoute('GET', '/dates', ['App\Controllers\ApartmentsController', 'dates']);
    $r->addRoute('POST', '/dates/search', ['App\Controllers\ApartmentsController', 'showAvailable']);
    $r->addRoute('GET', '/book/{id:\d+}', ['App\Controllers\ReservationsController', 'doReservation']);
    $r->addRoute('POST', '/validation/{id:\d+}', ['App\Controllers\ReservationsController', 'validateReservation']);

    //reservation results
    $r->addRoute('GET', '/reservations', ['App\Controllers\ReservationsController', 'index']);
    $r->addRoute('GET', '/reservation', ['App\Controllers\ReservationsController', 'show']);
    $r->addRoute('GET', '/cancel/{id:\d+}', ['App\Controllers\ReservationsController', 'cancel']);


});

// Fetch method and URI from somewhere
/**
 * @param \FastRoute\Dispatcher $dispatcher
 * @return void
 * @throws \Twig\Error\LoaderError
 * @throws \Twig\Error\RuntimeError
 * @throws \Twig\Error\SyntaxError
 */
function fetchMethodAndURIFromSomewhere(\FastRoute\Dispatcher $dispatcher): void
{
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            // ... 404 Not Found
            var_dump('404 Not Found');
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            // ... 405 Method Not Allowed
            var_dump('404 Not Allowed');
            break;
        case FastRoute\Dispatcher::FOUND:

            $controller = $routeInfo[1][0];
            $method = $routeInfo[1][1];

            $vars = $routeInfo[2];


            /** @var View $response */
            $response = (new $controller)->$method($vars);

            $loader = new FilesystemLoader('app/Views');
            $twig = new Environment($loader);

            if ($response instanceof View) {
                echo $twig->render($response->getPath(), $response->getVariables());
            }

            if ($response instanceof Redirect) {
                header('Location: ' . $response->getLocation());
                exit;
            }

            break;
    }
}

fetchMethodAndURIFromSomewhere($dispatcher);
