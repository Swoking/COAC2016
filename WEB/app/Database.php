<?php
namespace Coac;
use \PDO;

/**
* Permet la connexion avec la BDD MySQL avec PDO
*/
class Database {

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $options;
	private $pdo;
	
	/**
	 * Initialise la connextion
	 * @param $db_name string Nom de la BDD
	 * @param $db_user Nom d'utilisateur de la BDD
	 * @param $db_pass Mot de passe de l'utilisateur de la BDD
	 * @param $db_host adresse du serveur où se situe la BDD
	 */
	public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = '127.0.0.1' ) {
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}


	/**
	 * Connexion a la BDD et ajout des erreur MySQL a sur la page
	 */
	private function getPDO() {
		if ($this->pdo === null){
			$pdo = new PDO('mysql:dbname=COAC2016;host=127.0.0.1', 'root', 'root');
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$pdo->exec("SET NAMES 'utf8';");
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	/**
	 * Exécute une requéte et la retourne sous forme d'objets
	 * @param $statement string requéte a exécuter 
	 * @return $datas Retourne les données sous forme d'objet
	 */
	public function query($statement, $class_name) {
		$res = $this->getPDO()->query($statement);
		var_dump($res->rowCount());
		if($res->rowCount() > 1) {
			$datas = $res->fetchAll( PDO::FETCH_CLASS, $class_name );
			return $datas;
		} elseif ($res->rowCount() === 1) {
			$datas = $res->fetch(PDO::FETCH_ASSOC);
			return $datas;
		}
	}

	public function prepare($statement, $attributes, $one = false) {
		$req = $this->getPDO()->prepare()->prepare($statement);
		$req->execute($attributes);
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		if($one) {
			$datas = $req->fetch();
		} else {
			$datas = $req->fetchAll();
		}
		return $datas;
	}

}