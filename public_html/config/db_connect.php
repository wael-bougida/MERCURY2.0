<?php 
	// connect to the database
	$conn = new mysqli('localhost','group19','pXHcA0', 'group19');
	// $conn = new mysqli('localhost','tuanpham', 'test1234', 'Housing' );
	if($conn->connect_error) {
		echo '<div>Could not connect to database server:</div>';
		echo '<div>'. $conn->connect_error .'</div>';
	}