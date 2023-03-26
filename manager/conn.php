<?php
	// $conn = new mysqli('localhost', 'root', 'ERF7VK7GI2BWN8EQNQNBNTXWESQ25JUW', 'marketing');
	$conn = new mysqli('localhost', 'root', '', 'taskace');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>