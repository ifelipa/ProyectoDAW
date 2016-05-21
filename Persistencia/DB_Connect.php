<?php

define("DB", "proyecto"); 
define("USER", "test");
define("PASS", "123");

/**
 * Funcion conectar()
 * Funcion que permite conectarse a la base de datos
 * @return resource
 */
function valid_connection(){
	$strConn="host=localhost dbname=".DB." user=".USER." password=".PASS;
	return pg_connect($strConn);
}

/**
 * Funcion desconectar()
 * Funcion que libera el conjunto de resultados y cerramos la conexion
 * @param $query_result
 * @param $dbconn
 */
function close_connection($query_result, $dbconn){
	// Free resultset
    pg_free_result($query_result);
    // Closing connection
    pg_close($dbconn);
}

?>
