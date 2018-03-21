<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Exo_C5</title>
</head>
<body>

<div class="container-fluid">
	<div class="row">

		<form  method="post" class="col-md-5">
			<h1><big>Colyseum</big></h1>

			<input type="submit" class="mb-3 btn btn-dark container-fluid" id="envoyer" name="envoyer" value="Afficher tout les clients">

			<input type="submit" class="mb-3 btn btn-dark container-fluid" id="2" name="2" value="Afficher tout les types de spectacles">

			<input type="submit" class="mb-3 btn btn-dark container-fluid" name="3" value="Afficher les 20 premiers clients">
			<input type="submit" class="mb-3 btn btn-dark container-fluid" name="4" value="Afficher les clients fidèles">
			<div class="mb-3 container-fluid">
				<div class="row">
					<input type="submit" class="col-10 btn btn-dark " name="5" value="Afficher tout les clients dont le nom commence par...">
					<input type="text" class="col-2 text-center" name="test"  placeholder="Q">
				</div>
			</div>
			<input type="submit" class="mb-3 btn btn-dark container-fluid" name="6" value="Afficher tout les spectacles et les infos">
			<input type="submit" class="mb-3 btn btn-dark container-fluid" name="7" value="Afficher tout les clients et les infos">

		</form>
		<div class="col-md-7">
			<table class="table">


			<?php

				$connect = mysqli_connect("localhost", "Nicolas", "jesuisadmin", "colyseum");
				$connect -> query("SET NAMES UTF8");
				$lettre;
				
				if(!empty($_POST['envoyer'])) {
					$resultat = mysqli_query($connect, "SELECT * FROM clients");
					$affichage="";
					while($donnees = mysqli_fetch_assoc($resultat)){
					    $affichage .= '<tr><td>'.$donnees['lastName'].'</td><td>'.$donnees['firstName'].'</td></tr>';
					}
					echo "<tr><th>Nom</th><th>Prenom</th></tr>";
					echo $affichage;
					mysqli_free_result($resultat);
				}

				if(!empty($_POST['2'])) {
					$resultat = mysqli_query($connect, "SELECT type FROM showTypes");
					$affichage="";
					while($donnees = mysqli_fetch_assoc($resultat)){
					    $affichage .= '<tr><td>'.$donnees['type'].'</td></tr>';
					}
					echo "<tr><th>Type</th></tr>";
					echo $affichage;
					mysqli_free_result($resultat);
				}

				if(!empty($_POST['3'])) {
					$resultat = mysqli_query($connect, "SELECT * FROM clients ORDER BY id LIMIT 20");
					$affichage="";
					while($donnees = mysqli_fetch_assoc($resultat)){
					    $affichage .= '<tr><td>'.$donnees['lastName'].'</td><td>'.$donnees['firstName'].'</td></tr>';
					}
					echo "<tr><th>Nom</th><th>Prenom</th></tr>";
					echo $affichage;
					mysqli_free_result($resultat);
				}

				if(!empty($_POST['4'])) {
					$resultat = mysqli_query($connect, "SELECT * FROM clients WHERE card = 1");
					$affichage="";
					while($donnees = mysqli_fetch_assoc($resultat)){
					    $affichage .= '<tr><td>'.$donnees['lastName'].'</td><td>'.$donnees['firstName'].'</td></tr>';
					}
					echo "<tr><th>Nom</th><th>Prenom</th></tr>";
					echo $affichage;
					mysqli_free_result($resultat);
				}

				if(!empty($_POST['5'])) {
					$lettre = $_POST['test'];
					$resultat = mysqli_query($connect, "SELECT lastName, firstName FROM clients WHERE lastName LIKE '".$lettre."%' ORDER BY lastName");
					$affichage="";
					while($donnees = mysqli_fetch_assoc($resultat)){
					    $affichage .= '<tr><td>'.$donnees['lastName'].'</td><td>'.$donnees['firstName'].'</td></tr>';
					}
					echo "<tr><th>Nom</th><th>Prenom</th></tr>";
					echo $affichage;
					mysqli_free_result($resultat);
				}

				if(!empty($_POST['6'])) {
					$resultat = mysqli_query($connect, "SELECT * FROM shows ORDER BY title");
					$affichage="";
					while($donnees = mysqli_fetch_assoc($resultat)){
					    $affichage .= '<tr><td>Spectacle <strong>'.$donnees['title'].'</strong> par <strong>'.$donnees['performer'].'</strong> le '.$donnees['date'].' à '.$donnees['startTime'].'</td></tr>';
					}
					echo "<tr><th>Spectacle par le  à </th></tr>";
					echo $affichage;
					mysqli_free_result($resultat);
				}

				if(!empty($_POST['7'])) {
	                $resultat = mysqli_query($connect, "SELECT * FROM clients");
	                $affichage="";
	                while($donnees = mysqli_fetch_assoc($resultat)){
	                    if ($donnees['card'] == 1) {
	                        $cart="Oui";
	                    }
	                    else {
	                        $cart="Non";
	                    }
	                    $affichage .= '<tr>
	                        <td>'.$donnees['lastName'].'</td>
	                        <td>'.$donnees['firstName'].'</td>
	                        <td>'.$donnees['birthDate'].'</td>
	                        <td>'.$cart.'</td>
	                        <td>'.$donnees['cardNumber'].'</td>
	                    </tr>';
	                }
	                echo '<tr><th>Nom</th><th>Prenom</th><th>Qate de naissance</th><th>Carte de fidèlité</th><th>Numéro de carte</th></tr>';
	                echo $affichage;
	                mysqli_free_result($resultat);
                }

			?>
			
			</table>

		</div>
	</div>
</div>



</body>
</html> 