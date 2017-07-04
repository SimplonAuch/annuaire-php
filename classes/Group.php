<?php

	require_once("Database.php");



	class Group {

		private $nom;

		private $connexion;


		public function __construct( $name ){
			$this->nom = $name;

			$this->connexion = new Database();
		}



		public function save(){
			$req = $this->connexion->getConnexion()->prepare( 'INSERT INTO groupes(nom) VALUES(:nom);' );

			return $req->execute( array("nom" => $this->nom) );
		}


		public function get(){
			return $this->nom;
		}

	}




