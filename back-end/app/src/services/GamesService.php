<?php

/**
 * GamesService.php
 */

namespace App\Services;

class GamesService {

    private $storage;
    private $validation;

    /**
     * GamesService constructor
     */
    public function __construct() {
        $this->storage = new PersistenciaService();
        $this->validation = new ValidacionesService();
    }

    public function getById($id) {
        $response = [];

        if ($this->validation->isValidInt($id)) {
            // El query que vamos a ejecutar en la BD
            $query = "SELECT title, developer, description, console, date, rating, url FROM videogames WHERE id = :id LIMIT 1";

            // Los parametros del query
            $parameters = [":id"=> intval($id)];

            // El resultado de ejecutar la sentencia se almacena en la variable 'resultado'
            $queryResult = $this->storage->query($query, $parameters);

            //Si la sentencia tiene por lo mentos una fila, encontramos al juego
            $gameFound = array_key_exists("meta", $queryResult) && $queryResult["meta"]["count"] == 1;

            if ($gameFound) {
                $response["message"] = "Contacto encontrado!";
                $game = $queryResult["data"][0];
                $response["data"] = [
                    "id" => $id,
                    "title" => $game["title"],
                    "developer" => $game["developer"],
                    "description" => $game["description"],
                    "console" => $game["console"],
                    "date" => $game["date"],
                    "rating" => $game["rating"],
                    "url" => $game["url"]
                ];
            } else {
                $response["message"] = "Imposible encontrar juego con el id $id";
                $response["error"] = true;
            }
        } else {
            $response["message"] = "El campo del id es requerido";
            $response["error"] = true;
        }

        return $response;
    }

    public function listado($page = 1) {
        $response = [];
        $pageSize = 10;
        $page = $page == 0 ? 1 : intval($page);
        $offset = ($page - 1) * $pageSize;

        $query = "SELECT id, title, developer, description, console, date, rating, url FROM videogames LIMIT :pageSize OFFSET :offset";
        $parameters = [":pageSize" => $pageSize, ":offset" => $offset];
        $queryResult = $this->storage->query($query, $parameters);
        $gamesFound = array_key_exists("meta", $queryResult) &&
            $queryResult["meta"]["count"] > 0;

        if ($gamesFound) {
            $response["message"] = "Juegos encontrados satisfactoriamente.";
            $games = $queryResult["data"];

            foreach ($games as $game) {
                $response["data"][] = [
                    "id" => $id,
                    "title" => $game["title"],
                    "developer" => $game["developer"],
                    "description" => $game["description"],
                    "console" => $game["console"],
                    "date" => $game["date"],
                    "rating" => $game["rating"],
                    "url" => $game["url"]
                ];
            }

            $pageCount = $queryResult["meta"]["count"];
            $totalCount = $this->getTotal();

            $response["meta"] = [
                "gamesInThisPage"  	=> $pageCount,
                "gamesPerPage"     	=> $tamanoPagina,
                "pageTotal"       	=> ceil($totalCount / $tamanoPagina),
                "actualPage"        => $pagina,
                "gameTotal"       	=> $totalCount
            ];
        } else {
            $response["message"] = "No se encontraron juegos";
            $response["error"] = true;
        }

        return $response;
    }

    private function getTotal() {
        $query = "SELECT COUNT(*) AS total FROM videogames";
        $queryResult = $this->storage->query($query);
        return $queryResult["data"][0]["total"];
    }

    public function add($title, $developer, $description, $console, $date, $rating, $url) {
        $response = [];

        if ($this->validation->isValidString($title)) {
            if ($this->validation->isValidString($developer)) {
                if ($this->validation->isValidString($description)) {
                    if ($this->validation->isValidString($console)) {
                        if ($this->validation->isValidString($date)) {
                            if ($this->validation->isValidString($rating)) {
                                if ($this->validation->isValidString($url)) {
                                    $query = "INSERT INTO videogames (title, developer, description, console, date, rating, url) VALUES (:title, :developer, :description, :console, :date, :rating, :url)";
                                    $parameters = [
                                        ":title" => $title,
                                        ":developer" => $developer,
                                        ":description" => $description,
                                        ":console" => $console,
                                        ":date" => $date,
                                        ":rating" => $rating,
                                        ":url" => $url,
                                    ];
                                    $queryResult = $this->storage->query($query, $parameters);
                                    $videogameAdded = array_key_exists("meta", $queryResult) && $queryResult["meta"]["count"] == 1;

                                    if ($videogameAdded) {
                                        $response["message"] = "Juego creado exitosamente";
                                        $response["meta"]["id"] = $queryResult["meta"]["id"];
                                    } else {
                                        $response["error"] = true;
                                        $response["message"] = "Error creando juego";
                                    }
                                } else {
                                    $response["error"] = true;
                                    $response["message"] = "El url es inválido";
                                }
                            } else {
                                $response["error"] = true;
                                $response["message"] = "La puntuación es inválida";
                            }
                        } else {
                            $response["error"] = true;
                            $response["message"] = "La fecha es inválida";
                        }
                    } else {
                        $response["error"] = true;
                        $response["message"] = "La consola es inválida";
                    }
                } else {
                    $response["error"] = true;
                    $response["message"] = "Descripción inválida";
                }
            } else {
                $response["error"] = true;
                $response["message"] = "Desarrollador inválido";
            }
        } else {
            $response["error"] = true;
            $response["message"] = "Título inválido";
        }

        return $response;
    }

    public function update($id, $title, $developer, $description, $console, $date, $rating, $url) {
        $response = [];

        if ($this->validation->isValidString($title)) {
            if ($this->validation->isValidString($developer)) {
                if ($this->validation->isValidEmail($description)) {
                    if ($this->validation->isValidString($console)) {
                        if ($this->validation->isValidString($date)) {
                            if ($this->validation->isValidString($rating)) {
                                if ($this->validation->isValidString($url)) {
                                    if ($this->validation->isValidInt($id)) {
                                        $query = "
				                                  UPDATE videogames SET title = :title,
				                                                      	developer = :developer,
				                                                      	description = :description,
				                                                      	console = :console,
				                                                      	date = :date,
				                                                      	rating = :rating,
				                                                      	url = :url
				                                  WHERE id = :id
				                                ";
                                        $parameters = [
                                            ":title" 		=> $title,
                                            ":developer" 	=> $developer,
                                            ":description" 	=> $description,
                                            ":console" 		=> $console,
                                            ":date" 		=> $date,
                                            ":rating" 		=> $rating,
                                            ":url" 			=> $url,
                                            ":id" 			=> $id,
                                        ];
                                        $queryResult = $this->storage->query($query, $parameters);
                                        $gameUpdated = array_key_exists("meta", $queryResult) && $queryResult["meta"]["count"] == 1;

                                        if ($gameUpdated) {
                                            $response["message"] = "Juego actualizada exitosamente";
                                        } else {
                                            $response["error"] = true;
                                            $response["message"] = "Error actualizando juego";
                                        }
                                    } else {
                                        $response["error"] = true;
                                        $response["message"] = "El ID es inválido.";
                                    }
                                } else {
                                    $response["error"] = true;
                                    $response["message"] = "El url es inválido.";
                                }
                            } else {
                                $response["error"] = true;
                                $response["message"] = "El rating es inválido";
                            }
                        } else {
                            $response["error"] = true;
                            $response["message"] = "Fecha inválida";
                        }
                    } else {
                        $response["error"] = true;
                        $response["message"] = "Consola inválido";
                    }
                } else {
                    $response["error"] = true;
                    $response["message"] = "Descripción inválido";
                }
            } else {
                $response["error"] = true;
                $response["message"] = "Desarrollador inválido";
            }
        } else {
            $response["error"] = true;
            $response["message"] = "Título inválido";
        }

        return $response;
    }

    public function delete($id) {
        $response = [];

        if ($this->validation->isValidInt($id)) {
            $id = intval($id);
            $query = "DELETE FROM videogames WHERE id = :id";
            $parameters = [":id" => $id];
            $queryResult = $this->storage->query($query, $parameters);
            $gameDeleted = array_key_exists("meta", $queryResult) && $queryResult["meta"]["count"] == 1;

            if ($gameDeleted) {
                $response["message"] = "Juego eliminado.";
            } else {
                $response["message"] = "Imposible encontrar juego con el id $id.";
                $response["error"] = true;
            }
        } else {
            $response["message"] = "El campo id es requerido.";
            $response["error"] = true;
        }

        return $response;
    }
}
		