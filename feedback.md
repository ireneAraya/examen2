- Listar los juegos funciona parcialmente, no devuelve los IDs de los juegos y no cumple los datos que se pidieron
- Detalle funciona
- Delete en las rutas hace referencia a un controlador no existente, pero casi funciona
- Como les comentaba en el GitHub, los errores iniciaron por el nombre del controlador
- En el controlador, agregar/editar tiene los valores quemados, las verificaciones tienen un incorrecto llamado a la función `array_key_exists`
- En el servicio update hace referencia a una propiedad no existente
- Ninguna de las validaciones en los controladores o en los servicios funciona, por razones distintas
- No existe archivo de SQL con que generar las tablas, les adjunto mi aproximación a lo que pudieron haber usado
- El servicio solo tiene un par de pequeños cambios, por lo demás es lo mismo o que se presento en el ejemplo de las noticias 
- Lastimosamente ningún método es completamente funcional, ya que no tienen referencias al servicio de persistencia en
 el servicio de juegos

Varios de estos errores los pudieron haber pescado si el editor que usan les hubiera advertido, les recomiendo que 
consideren seriamente dejar de usar el editor que usan y cambiarlo por algo como PHPStorm que les advertiría sobre 
estos errores