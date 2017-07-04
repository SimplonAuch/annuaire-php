<?php
/*
 *
 *
 *	A simple PHP Directory
 *
 *	
 *
 *	used vars :
 *	 - $message : A global success/error message
 *
 *
 *
 *
 *
 *
 */




	require_once("classes/Database.php");
	require_once("classes/Contact.php");








	//-- Update or delete a contact


	if( isset($_POST['action']) ){

		switch( $_POST['action'] ){

			case 'upd':
				$c = new Contact( $_POST );
				$c->set( 'id', $_POST['id'] );
				$message = $c->save()
					? "Mise à jour effectuée avec succès !"
					: "La mise à jour a échoué :/";
				break;


			case 'del':
				$c = new Contact();
				$c->load( $_POST['id'] );
				$message = $c->delete()
					? "Suppression effectuée avec succès !"
					: "La suppression a échoué :/";
				break;
		}
	}






	//-- Get contact and group lists

	$bdd = new Database();

	$contacts = $bdd->getConnexion()->query('SELECT * FROM contacts;')->fetchAll();
	$groups = $bdd->getConnexion()->query('SELECT * FROM groupes;')->fetchAll();





	function user_in_group( $id, $arr ){
		foreach( $arr as $a){
			if( $a['id'] == $id ) return true;
		}
		return false;
	}



	require("header.php"); ?>





	<?php if( count($contacts) ): ?>

	<h1>Annuaire :</h1>

	<table class="table">
		<thead>
			<th>ID</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Entreprise</th>
			<th>Date naiss.</th>
			<th>Rue</th>
			<th>CP</th>
			<th>Ville</th>
			<th>Téléphone</th>
			<th>Groupes</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</thead>
		<tbody>

			<?php foreach( $contacts as $contact ): 

				$c = new Contact();

				$c->load( $contact['id'] );

				?>
				<tr>
					<form method="post" action="">

						<td><?=$c->get('id') ?></td>
						<td><input type="text" name="nom" value="<?=$c->get('nom') ?>" /></td>
						<td><input type="text" name="prenom" value="<?=$c->get('prenom') ?>" /></td>
						<td><input type="text" name="entreprise" value="<?=$c->get('entreprise') ?>" /></td>
						<td><input type="text" name="datenaissance" value="<?=$c->get('datenaissance') ?>" /></td>
						<td><input type="text" name="rue" value="<?=$c->get('rue') ?>" /></td>
						<td><input type="text" name="cp" value="<?=$c->get('cp') ?>" /></td>
						<td><input type="text" name="ville" value="<?=$c->get('ville') ?>" /></td>
						<td><input type="text" name="telephone" value="<?=$c->get('telephone') ?>" /></td>
						<td><?php

							$gr = $c->getGroups();

							foreach( $groups as $g ){

								$checked = user_in_group($g['id'],$gr) ? 'checked="checked"' : '';

								echo $g['nom'] . ' <input type="checkbox" name="group[' . $g['id'] . ']" '. $checked .' /> ';
							}

						?></td>

						<td>
							<input type="hidden" name="id" value="<?=$c->get('id'); ?>" />
							<input type="submit" name="action" value="upd" class="btn btn-success" />
						</td>

					</form>

					<form method="post" action="">

						<td>
							<input type="hidden" name="id" value="<?=$c->get('id'); ?>" />
							<input type="submit" name="action" value="del" class="btn btn-danger" />
						</td>

					</form>
				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>

	<?php endif; ?>







	<?php if( count($groups) ): ?>

	<h1>Groupes :</h1>

	<table class="table">
		<thead>
			<th>ID</th>
			<th>Nom</th>
		</thead>
		<tbody>

			<?php foreach( $groups as $g ): ?>
			<tr>
				<td><?=$g['id'] ?></td>
				<td><?=$g['nom'] ?></td>
			</tr>
			<?php endforeach; ?>

		</tbody>
	</table>

	<?php endif; ?>











	<?php require("footer.php"); ?>


