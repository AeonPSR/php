<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
		$hostname = "localhost";
		$username = "root";
		$password = "kali";
		$database = "books";

		$conn = new mysqli($hostname, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$id = intval($_POST['id']);
		$sql = "DELETE FROM livres WHERE id = $id";

		if ($conn->query($sql) === TRUE) {
			echo "Record deleted successfully.";
		} else {
			echo "Error deleting record: " . $conn->error;
		}

		$conn->close();
	} else {
		echo "Error: Missing book ID.";
	}

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>