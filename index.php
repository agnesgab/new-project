<?php

use App\Redirect;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\MysqlCartRepository;
use App\Repositories\Product\MysqlProductRepository;
use App\Repositories\Product\ProductRepository;
use App\View;
use FastRoute\Dispatcher;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

session_start();
$_SESSION['id'] = 1;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/products', ['App\Controllers\ProductsController', 'index']);
    $r->addRoute('GET', '/add', ['App\Controllers\ProductsController', 'addProduct']);
    $r->addRoute('POST', '/saved', ['App\Controllers\ProductsController', 'storeProduct']);
    $r->addRoute('GET', '/show/{id:\d+}', ['App\Controllers\ProductsController', 'show']);
    $r->addRoute('POST', '/buy/{id:\d+}', ['App\Controllers\CartController', 'addToCart']);
    $r->addRoute('GET', '/cart', ['App\Controllers\CartController', 'showCart']);
    $r->addRoute('GET', '/remove/{id:\d+}', ['App\Controllers\CartController', 'removeFromCart']);

});

// Fetch method and URI from somewhere
/**
 * @param Dispatcher $dispatcher
 * @return void
 * @throws \Twig\Error\LoaderError
 * @throws \Twig\Error\RuntimeError
 * @throws \Twig\Error\SyntaxError
 */
function fetchMethodAndURIFromSomewhere(Dispatcher $dispatcher): void
{
    $builder = new DI\ContainerBuilder();
    $builder->addDefinitions([
        ProductRepository::class => DI\create(MysqlProductRepository::class),
        CartRepository::class => DI\create(MysqlCartRepository::class)
    ]);
    $container = $builder->build();

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
            $response = (new $controller($container))->$method($vars);

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
