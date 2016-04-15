<?php

/**
* GamesController.php
*/

namespace App\Controllers;

use App\Services\GamesService;
use Slim\Http\Request;

class ContactosController {
	private $gamesService;

	/**
	* GamesController constructor
	*/
	public function __construct() {
		$this-> gamesService = new GamesService();
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
		$title = null;
		$developer = null;
		$description = null;
		$console = null;
		$date = null;
		$rating = null;
		$url = null; 

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