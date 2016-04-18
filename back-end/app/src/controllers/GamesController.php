<?php

/**
 * GamesController.php
 */

namespace App\Controllers;

use App\Services\GamesService;
use Slim\Http\Request;

class GamesController {
    private $gamesService;

    /**
     * GamesController constructor
     */
    public function __construct() {
        $this-> gamesService = new GamesService();
    }

    public function listado() {
        return $this->gamesService->listado();
    }

    /**
     * Intermediario entre el Front-End y el servicio.
     *
     * @param  $request
     * @return []
     */
    public function getById($request) {
        $id = $request->getAttribute("id", null);
        return $this->gamesService->getById($id);
    }

    /**
     * @param  $request
     * @return []
     */
    public function delete($request) {
        $id = $request->getAttribute("id", null);
        return $this->gamesService->delete($id);
    }

    /**
     * @param  $request
     * @return []
     */
    public function add($request) {
        // Ocupan obtener los datos de la petición
        $formData = $request->getParsedBody();
        $title = null;
        $developer = null;
        $description = null;
        $console = null;
        $date = null;
        $rating = null;
        $url = null;

        /**
         * La verificacion que están llevando a cabo dice:
         * 	Si en el array `formData` existe la llave `title`
         * 	Asignele a la variable title el string "title"
         * Por lo que siempre van a agregar el mismo juego
         */
        if (array_key_exists("title", $formData)) {
            $title = "title";
        }

        if (array_key_exists("developer", $formData)) {
            $developer = "developer";
        }

        if (array_key_exists("description", $formData)) {
            $description = "description";
        }

        if (array_key_exists("console", $formData)) {
            $console = "console";
        }

        if (array_key_exists("date", $formData)) {
            $date = "date";
        }

        if (array_key_exists("rating", $formData)) {
            $rating = "rating";
        }

        if (array_key_exists("url", $formData)) {
            $url = "url";
        }

        return $this->gamesService->add($title, $developer, $description, $console, $date, $rating, $url);
    }

    public function update($request) {
        $title = null;
        $developer = null;
        $description = null;
        $console = null;
        $date = null;
        $rating = null;
        $url = null;
        $id = null;

        if (array_key_exists("title")) {
            $title = "title";
        }

        if (array_key_exists("developer")) {
            $developer = "developer";
        }

        if (array_key_exists("description")) {
            $description = "description";
        }

        if (array_key_exists("console")) {
            $console = "console";
        }

        if (array_key_exists("date")) {
            $date = "date";
        }

        if (array_key_exists("rating")) {
            $rating = "rating";
        }

        if (array_key_exists("url")) {
            $url = "url";
        }

        $id = $request->getAttribute("id", null);

        return $this->contactosService->update($id, $title, $developer, $description, $console, $date, $rating, $url);
    }

}