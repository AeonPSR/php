<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

	$hostname = "localhost";
	$username = "root";
	$password = "kali";
	$database = "books";

	$conn = new mysqli($hostname, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$id = $_POST['id'];
	$titre = $_POST['titre'];
	$auteur = $_POST['auteur'];
	$categorie = $_POST['categorie'];
	$disponible = isset($_POST['disponible']) ? 1 : 0; // Convert checkbox value to 1 or 0

	$sql = "UPDATE livres SET titre='$titre', auteur='$auteur', categorie='$categorie', disponible=$disponible WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		header("Location: bdd_tp.php");
		exit;
	} else {
		echo "Error updating record: " . $conn->error;
	}
	$conn->close();
} else {
	echo "Form submission error.";
}
?>