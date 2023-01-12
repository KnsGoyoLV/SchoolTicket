<?php
	$env = parse_ini_file('ID.env');
	$db = new mysqli($env['hostname'],$env['username'],$env['password'],$env['database']);
	if(!$db){
		die("Pieslegties neizdevas: ".mysqli_connect_error());
	}
?>
