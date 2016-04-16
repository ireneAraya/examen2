<?php

/**
 * index.php
 * Inicia la aplicación y sirve como enrutador para el back-end.
 */

require "bootstrap.php";

use Slim\Http\Request;
use Slim\Http\Response;

$slimApp = new \Slim\App();

// Definimos nuestras rutas

$slimApp->get(
    "/game",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $result = $controller->listado($request);
        return $response->withJson($result);
    }
);

// Lista de juegos
$slimApp->get(
    "/games[/{page}]",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new \App\Controllers\GamesController();
        $result = $controller->listado($request);
        return $response->withJson($result);
    }
);

// Una entrada específica
$slimApp->get(
    "/game/{id}",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $result = $controller->getById($request);
        return $response->withJson($result);
    }
);

// Crear nuevos juegos
$slimApp->post(
    "/game/add",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $resultado = $controller->add($request);
        return $response->withJson($resultado);
    }
);

// Editar un juego
$slimApp->post(
    "/game/update/{id}",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\GamesController();
        $resultado = $controller->update($request);
        return $response->withJson($resultado);
    }
);

// Eliminar un juego
$slimApp->get(
    "/game/delete/{id}",
    function ($request, $response) {
        /** @var Response $response */
        $controller = new App\Controllers\ContactosController();
        $result = $controller->delete($request);
        return $response->withJson($result);
    }
);

// Corremos la aplicación.
$slimApp->run();
