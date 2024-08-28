<?php
function Conectarse(){
	$Conexion =  mysqli_connect("localhost","root","","cita");
	return $Conexion;
}
?>