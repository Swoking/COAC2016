<?php
namespace Coac\Table;
use Coac\Table\Carte;
use Coac\Table\Log;


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
        $db = new \Coac\Database();
        return $db->query("SELECT id, Nom, Prenom FROM Etudiant");
    }


	static function getAll($id)
    {
        $db = new \Coac\Database();
        return $db->query("SELECT id, Nom, Prenom FROM Etudiant WHERE id_Promo = ?", [$id]);
    }

    static function getIdEleve($nom, $prenom, $classe)
    {
        $db = new \Coac\Database();
        return $db->query("SELECT id FROM Etudiant WHERE Nom = ? 
                                                    AND Prenom = ?
                                                    AND id_Promo = ?", [$nom, $prenom, $classe]);
    }

    static function getFromId($id)
    {
        $db = new \Coac\Database();
        return $db->query("SELECT * FROM Etudiant WHERE id = ?", [$id]);
    }

    public static function delete($id, $nom, $prenom){
        $db = new \Coac\Database();
        $db->query("UPDATE Etudiant SET id_Promo = '0' WHERE id = ?", [$id]);

        $etat = "Rendu" ;

        foreach (Carte::getFromId($id) as $data){

        $db->query("UPDATE Carte SET Etat = '$etat' WHERE id = ?", [$id]);

        Log::carte_rendue($nom, $prenom );

        }



    }

    public static function add($nom, $prenom, $classe, $lycee, $add, $ville, $cp, $email, $sexe, $date_naiss) {
        $db = new \Coac\Database();
        if ($db->query("INSERT INTO Etudiant(`id`, `Nom`, `Prenom`, `id_Promo`, `id_Lycee`, `Adresse`, `Ville`, `CP`, `Email`, `Sexe`, `Date_Naissance`, `Image`) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL) ",
                  [$nom, $prenom, $classe, $lycee, $add, $ville, $cp, $email, $sexe, $date_naiss])){
            
        return true ;
        }

        return false ;
    }

    public static function edit($id, $nom, $prenom, $classe, $lycee, $add, $ville, $cp, $email, $sexe, $date_naiss){
        $db = new \Coac\Database();
        $db->query("UPDATE Etudiant SET  Nom = ?,
                                                Prenom = ?,
                                                id_Promo = ?,
                                                id_Lycee = ?,
                                                Adresse = ?,
                                                Ville = ?,
                                                CP = ?,
                                                Email = ?,
                                                Sexe = ?,
                                                Date_Naissance = ? WHERE id = ?", 
                    [$nom, $prenom, $classe, $lycee, $add, $ville, $cp, $email, $sexe, $date_naiss, $id]);

    }




    public static function editButton($id){
        $html = "<a href='?p=eleve.edit&id=" . $id . "' />";
        $html .= "<img src='img/modif.png' border='0' width='20' height='20' value='75'>";
        return $html .= "</a>";
    }

    public static function deleteButton($id){
        $db = new \Coac\Database();
		$name = $db->query("SELECT Nom,Prenom,id FROM Etudiant WHERE id = ?", [$id])->fetch();
        $html = "<a href='?p=eleve.delete&id=" . $id . "' ";
        $html .= "onclick=\"return(confirm('Confirmer la suppression de :\\n\\n" . $name->Nom . " " . $name->Prenom/* . $liste->Nom $liste->prenom*/ . "'));\">";
        $html .= "<img src='img/supprime.png' border='0' width='20' height='20' value=" /* . $liste->id*/ . "  name ='suppr' />";
        return $html .= "</a>";
    }

}