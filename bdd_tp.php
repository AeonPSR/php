<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Database Content</title>
		<style>
			table {
				border-collapse: collapse;
				width: 100%;
			}
			th, td {
				border: 1px solid #ddd;
				padding: 8px;
				text-align: left;
			}
			th {
				background-color: #f2f2f2;
			}
		</style>
	</head>
	<body>

		<h2>Add New Book</h2>
		<form action="bdd_tp.php" method="post">
			<label for="titre">Titre:</label><br>
			<input type="text" id="titre" name="titre" required><br>
			<label for="auteur">Auteur:</label><br>
			<input type="text" id="auteur" name="auteur" required><br>
			<label for="categorie">Catégorie:</label><br>
			<input type="text" id="categorie" name="categorie"><br>
			<label for="disponible">Disponible:</label><br>
			<input type="checkbox" id="disponible" name="disponible" value="1" checked><br>
			<input type="submit" value="Ajouter">
		</form>
		<?php
			$hostname = "localhost";
			$username = "root";
			$password = "kali";
			$database = "books";


			$conn = new mysqli($hostname, $username, $password, $database);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		?>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				// Retrieve form data
				$titre = $_POST['titre'];
				$auteur = $_POST['auteur'];
				$categorie = $_POST['categorie'];
				$disponible = isset($_POST['disponible']) ? 1 : 0;

				// Prepare SQL statement
				$sql = "INSERT INTO livres (titre, auteur, categorie, disponible) VALUES ('$titre', '$auteur', '$categorie', $disponible)";

				// Execute SQL statement
				if ($conn->query($sql) === TRUE) {
					echo "Nouveau livre ajouté avec succès.";
				} else {
					echo "Erreur lors de l'ajout du livre : " . $conn->error;
				}
			}
		?>

		<h2>Content of "livres" Table</h2>
		<table>
			<tr>
				<th>ID</th>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Catégorie</th>
				<th>Disponible</th>
			</tr>
			<?php
				$sql = "SELECT * FROM livres";
				$result = $conn->query($sql);
	/*
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id"] . "</td><td>" . $row["titre"] . "</td><td>" . $row["auteur"] . "</td><td>" . $row["categorie"] . "</td><td>" . ($row["disponible"] ? "Oui" : "Non") . "</td></tr>";
				}
	*/
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["id"] . "</td>";
					echo "<td>" . $row["titre"] . "</td>";
					echo "<td>" . $row["auteur"] . "</td>";
					echo "<td>" . $row["categorie"] . "</td>";
					echo "<td>" . ($row["disponible"] ? "Oui" : "Non") . "</td>";
					// Add delete button with onclick event
					echo "<td><button onclick=\"deleteRecord(" . $row["id"] . ")\">&#128465;</button></td>";
					echo "</tr>";
				}
			?>

<script>
	//Call another file to handle the deletion through the button.
	function deleteRecord(id) {
		if (confirm("Êtes-vous sûr de vouloir supprimer ce livre?")) {
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "/test1/delete_book.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					location.reload();
				}
			};
			xhr.send("id=" + id);
		}
	}
</script>


		</table>

		<h2>Content of "emprunteurs" Table</h2>
		<table>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Email</th>
				<th>ID Livre</th>
				<th>Date Emprunt</th>
				<th>Date Retour</th>
			</tr>
			<?php
				$sql = "SELECT * FROM emprunteurs";
				$result = $conn->query($sql);

				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nom"] . "</td><td>" . $row["email"] . "</td><td>" . $row["id_livre"] . "</td><td>" . $row["date_emprunt"] . "</td><td>" . $row["date_retour"] . "</td></tr>";
				}

			?>
		</table>

			<?php
				error_reporting(E_ALL);
				ini_set('display_errors', 1);

				$conn->close();
			?>
	</body>
</html>