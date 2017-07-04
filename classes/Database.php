<?php



class Database {


	private $host = 'localhost';
	private $db = 'annuairephp';
	private $user = 'annuairephp';
	private $pass = 'yGnDC4lM4L16431E';

	private $connexion;




	public function __construct(){
		try
		{
			$this->connexion = new PDO("mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8", $this->user, $this->pass);
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}


	public function getConnexion(){
		return $this->connexion;
	}



}



