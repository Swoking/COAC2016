<?php
namespace Coac\Table;

/**
* 
*/
class Promos
{
	
    /**
     * Met en place un sélécteur magique
     */
    /*public function __get($key){
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method;
        return $this->$key;
    }*/

    public static function getAll(){
        $db = new \Coac\Database();
        return $db->query("SELECT * FROM Promo");
    }

   static function getFromId($id)
    {
        $db = new \Coac\Database();
        return $db->query('SELECT * FROM Promo WHERE id = ?', [$id]);
    }

    public static function delete($id){
        $db = new \Coac\Database();
        $db->query("DELETE FROM Promo WHERE id = ?", [$id]);
    }

    public static function add($entree, $sortie, $name, $filiere){
        $db = new \Coac\Database();
        $db->query( "INSERT INTO Promo (`id`, `Entree`, `Sortie`, `Nom`, `Filiere`) 
                    VALUES (NULL, ?, ?, ?, ?);", [$entree, $sortie, $name, $filiere]); 
    }

    public static function edit($id, $entree, $sortie, $name, $filiere){
        $db = new \Coac\Database();
        $db->query("UPDATE Promo SET            Entree = ?,
                                                Sortie = ?,
                                                Nom = ?,
                                                Filiere = ? WHERE id = ? ", [$entree, $sortie, $name, $filiere, $id]);
    }

    



    public static function editButton($id){
        $html = "<a href='?p=promos.edit&id=" . $id . "' />";
        $html .= "<img src='img/modif.png' border='0' width='20' height='20' value='75'>";
        return $html .= "</a>";
    }

    public static function deleteButton($id){
        $db = new \Coac\Database();
	    $name = $db->query("SELECT Nom FROM Promo WHERE id = ?", [$id])->fetch();
        $html = "<a href='?p=promos.delete&id=" . $id . "' ";
        $html .= "onclick=\"return(confirm('Confirmer la suppression de :\\n\\n" . $name->Nom/* . $liste->Nom $liste->prenom*/ . "'));\">";
        $html .= "<img src='img/supprime.png' border='0' width='20' height='20' value=" /* . $liste->id*/ . "  name ='suppr' />";
        return $html .= "</a>";
    }














	public function getSelected($id) {
		if ( $this->id === $id ) return 'selected';
		return '';
	}

	/**
	 * Retourne l'ID de la classe sélétionner
	 * @return int ID de la classe qui est dans l'URL
	 */
	public static function getIdClasse()
	{
		$db = new \Coac\Database();
		foreach ($db->query("SELECT * FROM Classe", 'Coac\Table\Eleve') as $classe) { // parcoure toute les classe
			if ($classe->Nom === $_GET['classe']) return $classe->id; // si Nom de la classe est == a la classe en URL alors retourne sont ID
		}
		return NULL; // retourne NULL si pas de classe sélétioner
	}

}