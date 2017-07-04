<?php

	require_once("Database.php");


	class Contact {

		private $id;
		private $nom;
		private $prenom;
		private $entreprise;
		private $datenaissance;
		private $rue;
		private $cp;
		private $ville;
		private $telephone;
		private $group;

		private $cnx;



		public function __construct( $data=null ){

			if( isset($data) ){
				$this->id = $data['id'];
				$this->nom = $data['nom'];
				$this->prenom = $data['prenom'];
				$this->entreprise = $data['entreprise'];
				$this->datenaissance = $data['datenaissance'];
				$this->rue = $data['rue'];
				$this->cp = $data['cp'];
				$this->ville = $data['ville'];
				$this->telephone = $data['telephone'];

				if( isset($data['group']) )
					$this->group = $data['group'];
			}

			$this->cnx = new Database();
		}




		public function load( $id ){
			$req = $this->cnx->getConnexion()->prepare('SELECT * FROM contacts WHERE id = :id');
			$req->execute( array('id'=>$id) );

			$data = $req->fetch();

			$this->id = $data['id'];
			$this->nom = $data['nom'];
			$this->prenom = $data['prenom'];
			$this->entreprise = $data['entreprise'];
			$this->datenaissance = $data['datenaissance'];
			$this->rue = $data['rue'];
			$this->cp = $data['cp'];
			$this->ville = $data['ville'];
			$this->telephone = $data['telephone'];
		}




		/*
			Insert OR update a contact.
			The difference is made according to the existance of $this->id :
				- if $this->id is set : do an UPDATE query
				- Otherwise : do an INSERT query !
		*/
		public function save(){


			if( $this->id ){

				$req = $this->cnx->getConnexion()->prepare('
					UPDATE contacts SET nom = :nom, prenom = :prenom, entreprise = :entreprise,
					datenaissance = :datenaissance, rue = :rue, cp = :cp, ville = :ville, 
					telephone = :telephone
					WHERE id = :id;
				');

				$result1 = $req->execute(array(
					"id" => $this->id,
					"nom" => $this->nom,
					"prenom" => $this->prenom,
					"entreprise" => $this->entreprise,
					"datenaissance" => $this->datenaissance,
					"rue" => $this->rue,
					"cp" => $this->cp,
					"ville" => $this->ville,
					"telephone" => $this->telephone
				));


			} else {

				$req = $this->cnx->getConnexion()->prepare('
					INSERT INTO contacts(nom, prenom, entreprise, datenaissance, rue, cp, ville, telephone)
					VALUES(:nom, :prenom, :entreprise, :datenaissance, :rue, :cp, :ville, :telephone);
				');

				$result1 = $req->execute(array(
					"nom" => $this->nom,
					"prenom" => $this->prenom,
					"entreprise" => $this->entreprise,
					"datenaissance" => $this->datenaissance,
					"rue" => $this->rue,
					"cp" => $this->cp,
					"ville" => $this->ville,
					"telephone" => $this->telephone
				));

				$this->id = $this->cnx->getConnexion()->lastInsertId();
			}




			//-- save the group list
			/*
				first, delete all the previous groups
				then record the right group list
			*/

			$this->cnx->getConnexion()->query('DELETE FROM appartenir WHERE fk_contact = ' . $this->id);

			$req = $this->cnx->getConnexion()->prepare('
				INSERT INTO appartenir(fk_contact, fk_group)
				VALUES(:fk_contact, :fk_group);
			');

			foreach( $this->group as $key => $value ){

				$result2 = $req->execute(array(
					"fk_contact" => $this->id,
					"fk_group" => $key
				));

				if( ! $result2 ){
					die( "Something went wrong : " . $req->errorInfo()[2] );
				}
			}

			return true;

		}





		public function delete(){

			// We need to know which contact to delete : use $c->load()

			if( ! $this->id ) {
				return false;
			}

			// Deleting the contact AND the associated groups

			$req = $this->cnx->getConnexion()->prepare('
				DELETE FROM appartenir WHERE fk_contact = :id;
				DELETE FROM contacts WHERE id = :id;
			');

			return $req->execute( array('id'=>$this->id) );
		}





		public function get( $name ){
			return $this->{$name};
		}




		public function set( $name, $value ){
			$this->{$name} = $value;
		}




		public function getGroups(){

			if( $this->id ){

				$req = $this->cnx->getConnexion()->prepare('
					SELECT
						groupes.id,
						groupes.nom

					FROM groupes
						JOIN appartenir ON groupes.id = appartenir.fk_group
						JOIN contacts ON appartenir.fk_contact = contacts.id

					WHERE contacts.id = :id ;
				');

				$req->execute( array('id'=>$this->id) );
				return $req->fetchAll();
			}
		}



	}







