<?php
declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Liteslim\Controllers\UserController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Liteslim\Test;

return function (App $app) {
    // Test route
    $app->get('/test', [Test::class, 'registerUser']);

    $app->get('/', function (Request $request, Response $response) {
        $body = $response->getBody();
        $body->write("Hello Litesupabase!");
        return $response;
    });

    // API Routes
    $app->group('/api', function (RouteCollectorProxy $group) {
        // Auth routes
        $group->get('/users', [UserController::class, 'getUsers']);
    });

    // Register CORS middleware
    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    // Add OPTIONS route for CORS preflight requests
    $app->options('/{routes:.+}', function ($request, $handler) {
        return $handler->handle($request)
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};
