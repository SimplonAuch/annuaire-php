<?php



	require "classes/Group.php";


	$successGroup = "";





	//-- Create a new group in DB

	if( isset($_POST['groupe']) ){

		$g = new Group($_POST['groupe']);

		$successGroup = $g->save();

		if( $successGroup )
			$message = "Enregistrement effectué avec succès !";
			else
			$message = "Il y a eu un problème lors de l'enregistrement :/";
	}




?>


	<?php require("header.php"); ?>



	<h1>Ajouter un groupe</h1>



	<form method="post" action="groupes.php">

		<p>
			<label for="groupe">Nom du groupe*</label>
			<input type="text" name="groupe" value="<?php if(!isset($successGroup)) $g->get(); ?>" required />
		</p>

		<input type="submit" name="action" value="Enregistrer" />		

		<p>* : champs obligatoires</p>
		
	</form>




	<?php require("footer.php"); ?>


