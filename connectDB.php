<?php
	$db =mysqli_connect('localhost','Daniels','Parole1','internetveikals');
	if(!$db){
		die("Pieslegties neizdevas: ".mysqli_connect_error());
	}
?>
