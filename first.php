<!DOCTYPE html>
<html>
<head>
	<title>Hello, World!</title>
</head>
<body>
	<?php 
		echo "Somme:<br>"; 
		$x = 7;
		$y = 10;
		$z = $y + $x;
		echo "La somme de $x et $y est $z<br>";

		if (date("H") >= 18) {
			echo "Bonsoir<br>";
		} else {
			echo "Bonjour<br>";
		}

		function saluer($nom) {
			echo "Bonjour, $nom!<br>";
		}
		saluer("Aeon");
	
		$jours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
		foreach ($jours as $jour) {
			echo $jour . "<br>";
		}


	?>

	<form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username">
        <button type="submit">Soumettre</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $utilisateur = $_POST["username"];
        echo "Bonjour, $utilisateur!";
    }
    ?>
</body>
</html>