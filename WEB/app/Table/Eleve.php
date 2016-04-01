<?php
namespace Coac\Table;

/**
* 
*/
class Eleve
{

	/**
	 * Met en place un sélécteur magique
	 */
	public function __get($key){
		$method = 'get' . ucfirst($key);
		$this->$key = $this->$method;
		return $this->$key;
	}

    static function getAllNoId()
    {
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT id,Nom,Prenom FROM Etudiant", 'Coac\Table\Eleve');
    }


	static function getAll($id)
    {
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT id,Nom,Prenom FROM Etudiant WHERE id_Promo = $id", 'Coac\Table\Eleve');
    }

    static function getAllIdEleve($nom, $prenom, $classe)
    {
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT id FROM Etudiant WHERE Nom = '$nom' 
                                                    AND Prenom = '$prenom' 
                                                    AND id_Promo = '$classe'", 'Coac\Table\Eleve');
    }

    static function getFromId($id)
    {
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT * FROM Etudiant WHERE id = $id", 'Coac\Table\Eleve');
    }

    public static function delete($id){
        $db = new \Coac\Database('COAC2016');
        $db->query("DELETE FROM Etudiant WHERE id = $id", 'Coac\Table\Eleve');
    }

    public static function add($nom, $prenom, $classe, $lycee, $add, $ville, $cp, $email, $sexe, $date_naiss) {
        $db = new \Coac\Database('COAC2016');
        $db->query("INSERT INTO Etudiant(`id`, `Nom`, `Prenom`, `id_Promo`, `id_Lycee`, `Adresse`, `Ville`, `CP`, `Email`, `Sexe`, `Date_Naissance`, `Image`) 
                                VALUES (NULL, '$nom', '$prenom', '$classe', '$lycee', '$add', '$ville', '$cp', '$email', '$sexe', '$date_naiss', NULL) ", '\Coac\Table\Eleve');

        
    }

    public static function edit($id, $nom, $prenom, $classe, $lycee, $add, $ville, $cp, $email, $sexe, $date_naiss){
        $db = new \Coac\Database('COAC2016');
        $db->query("UPDATE Etudiant SET  Nom = '$nom',
                                                Prenom = '$prenom',
                                                id_Promo = '$classe',
                                                id_Lycee = '$lycee',
                                                Adresse = '$add',
                                                Ville = '$ville',
                                                CP = '$cp',
                                                Email = '$email',
                                                Sexe = '$sexe',
                                                Date_Naissance = '$date_naiss' WHERE id = '$id'", '\Coac\Table\Eleve');

    }




    public static function editButton($id){
        $html = "<a href='?p=eleve.edit&id=" . $id . "' />";
        $html .= "<img src='img/modif.png' border='0' width='20' height='20' value='75'>";
        return $html .= "</a>";
    }

    public static function deleteButton($id){
        $db = new \Coac\Database('COAC2016');
		$name = $db->query("SELECT Nom,Prenom,id FROM Etudiant WHERE id = " . $id, '\Coac\Table\Eleve');
        $html = "<a href='?p=eleve.delete&id=" . $id . "' ";
        $html .= "onclick=\"return(confirm('Confirmer la suppression de :\\n\\n" . $name[0]->Nom . " " . $name[0]->Prenom/* . $liste->Nom $liste->prenom*/ . "'));\">";
        $html .= "<img src='img/supprime.png' border='0' width='20' height='20' value=" /* . $liste->id*/ . "  name ='suppr' />";
        return $html .= "</a>";
    }

}