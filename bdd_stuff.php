<!DOCTYPE html>
<html>
<head>
	<title>Hello, World!</title>
</head>
<body>

<?php
// Paramètres de connexion à la base de données
$hostname = "localhost";
$username = "root";
$password = ""; // Laissez vide si aucun mot de passe n'est défini
$database = "testdb";

// Connexion à la base de données
$connexion = new mysqli($hostname, $username, $password, $database);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

echo "Connexion réussie à la base de données.";
?>

</body>
</html>