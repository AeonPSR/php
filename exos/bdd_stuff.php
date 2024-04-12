<!DOCTYPE html>
<html>
	<head>
		<title>Bdd</title>
	</head>
	<body>

		<?php
		$hostname = "localhost";
		$username = "root";
		$password = "kali";
		$database = "testdb";

		function insertUser($connexion, $name, $email) {
			$sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

			if ($connexion->query($sql) === TRUE) {
				echo "Utilisateur inséré avec succès.<br>";
			} else {
				echo "Erreur lors de l'insertion de l'utilisateur : " . $connexion->error . "<br>";
			}
		}

		$connexion = new mysqli($hostname, $username, $password, $database);
		if ($connexion->connect_error) {
			echo "Échec de la connexion à la base de données : ".$connexion->connect_error;
			die();
		}
		echo "Connexion réussie à la base de données.<br>";

		$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(50) NOT NULL,
			email VARCHAR(50) NOT NULL
		)";

		if ($connexion->query($sql) === TRUE) {
			echo "La table 'users' a été créée avec succès.<br>";
		} else {
			echo "Erreur lors de la création de la table : " . $connexion->error;
		}
		// Récupération des utilisateurs depuis la table "users"
		$sql_select = "SELECT * FROM users";
		$result = $connexion->query($sql_select);
		// Affichage des utilisateurs
		if ($result->num_rows > 0) {
			echo "<table border='1'>
					<tr>
						<th>ID</th>
						<th>Nom</th>
						<th>Email</th>
					</tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr>
						<td>".$row["id"]."</td>
						<td>".$row["name"]."</td>
						<td>".$row["email"]."</td>
					</tr>";
			}
			echo "</table>";
		} else {
			echo "Aucun utilisateur trouvé dans la base de données.";
		}

		$connexion->close();
		?>

	</body>
</html>