<?php

/**
 * index.php
 * Inicia la aplicación y sirve como enrutador para el back-end.
 */

require "bootstrap.php";

//use App\Controllers\GamesController;
use Slim\Http\Request;
use Slim\Http\Response;

$app = new \Slim\App();

// Definimos nuestras rutas

// Lista de juegos
$app->get(
    "/games[/{page}]",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $result = $controller->list($request);
        return $response->withJson($result);
    }
);

// Una entrada específica
$app->get(
    "/game/{id}",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $result = $controller->getById($request);
        return $response->withJson($result);
    }
);

// Crear nuevos juegos
$app->post(
    "/game/add",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $resultado = $controller->add($request);
        return $response->withJson($resultado);
    }
);

// Editar un juego
$app->post(
    "/game/update/{id}",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $resultado = $controller->update($request);
        return $response->withJson($resultado);
    }
);

// Eliminar un juego
$app->get(
    "/game/delete/{id}",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\ContactosController();
        $result = $controller->delete($request);
        return $response->withJson($result);
    }
);

// Corremos la aplicación.
$app->run();
