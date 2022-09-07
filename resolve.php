<?php
require_once('connection.php');
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$sql = "UPDATE tt SET status='1' WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
		header("location:home.php");
	} else {
		echo "Error updating record: " . $conn->error;
	}
}

?>