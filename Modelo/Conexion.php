<?php
function Conectarse(){
	$Conexion =  mysqli_connect("localhost","root","","citas");
	return $Conexion;
}
?>