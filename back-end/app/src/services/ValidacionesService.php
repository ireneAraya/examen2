<?php
/**
 * ValidacionesService.php
 * Distintas validaciones independendientes de la lógica de negocios.
 */

namespace App\Services;


class ValidacionesService
{
    /**
     * Verifica si una cadena de texto puede ser considerada texto válido.
     *
     * @param string $stringToCheck
     * @return bool
     */
    function isValidString($stringToCheck) {
        if (isset($stringToCheck)) {
            $trimmed = trim($stringToCheck);

            if (strlen($trimmed) > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Verifica si un valor es considerado un entero válido.
     *
     * @param $intToCheck
     * @return bool
     */
    function isValidInt($intToCheck) {
        if (isset($intToCheck)) {
            return intval($intToCheck) != 0;
        }

        return false;
    }
    
}
