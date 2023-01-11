<?php
	$db =mysqli_connect('localhost','root','','problema');
	if(!$db){
		die("Pieslegties neizdevas: ".mysqli_connect_error());
	}
?>
