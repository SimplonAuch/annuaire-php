<?php

	require_once("classes/Database.php");
	require_once("classes/Contact.php");

	$successContact = "";



	//-- Create a new contact in DB

	if( isset($_POST['nom']) ){

		$c = new Contact($_POST);

		$successContact = $c->save();

		if( $successContact )
			$message = "Enregistrement effectué avec succès !";
			else
			$message = "Il y a eu un problème lors de l'enregistrement :/";
	}



	//-- Load the whole group list

	$bdd = new Database();

	$groupes = $bdd->getConnexion()->query('SELECT * FROM groupes;');



?>


	<?php require("header.php"); ?>




	<h1>Ajouter un contact :</h1>


	<form action="contacts.php" method="post">

		<p>
			<label for="nom">Nom*</label>
			<input type="text" name="nom" value="<?php if(!isset($successContact)) $c->get('nom'); ?>" required />
		</p>

		<p>
			<label for="prenom">Prénom*</label>
			<input type="text" name="prenom" value="<?php if(!isset($successContact)) $c->get('prenom'); ?>" required />
		</p>

		<p>
			<label for="entreprise">Entreprise</label>
			<input type="text" name="entreprise" value="<?php if(!isset($successContact)) $c->get('entreprise'); ?>" />
		</p>

		<p>
			<label for="datenaissance">Date de naissance</label>
			<input type="text" name="datenaissance" value="<?php if(!isset($successContact)) $c->get('datenaissance'); ?>" />
		</p>

		<p>
			<label for="rue">Rue*</label>
			<input type="text" name="rue" value="<?php if(!isset($successContact)) $c->get('rue'); ?>" required />
		</p>

		<p>
			<label for="cp">Code postal*</label>
			<input type="text" name="cp" value="<?php if(!isset($successContact)) $c->get('cp'); ?>" required />
		</p>

		<p>
			<label for="ville">Ville*</label>
			<input type="text" name="ville" value="<?php if(!isset($successContact)) $c->get('ville'); ?>" required />
		</p>

		<p>
			<label for="telephone">Téléphone*</label>
			<input type="text" name="telephone" value="<?php if(!isset($successContact)) $c->get('telephone'); ?>" required />
		</p>

		<p>
			<label for="group">Groupe(s)*</label>

			<?php

			foreach( $groupes as $g ){

				echo $g['nom'] . ' <input type="checkbox" name="group[' . $g['id'] . ']" value="" /> ';
			}

			?>

		</p>

		<input type="submit" name="action" value="Enregistrer" />		

		<p>* : champs obligatoires</p>
	</form>





	<?php require("footer.php"); ?>


