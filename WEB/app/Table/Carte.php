<?php
namespace Coac\Table;

/**
* 
*/
class Carte 
{

	/**
	 * Met en place un sélécteur magique
	 */
	public function __get($key){
		$method = 'get' . ucfirst($key);
		$this->$key = $this->$method;
		return $this->$key;
	}

	static function getAll($id)
	{
		$db = new \Coac\Database('COAC2016');
		return $db->query("	SELECT Etudiant.id,Etudiant.Nom,Etudiant.Prenom,Carte.Num_Carte,Carte.id as id_Carte,Carte.id_Etudiant, Carte.Etat
							FROM Etudiant,Carte 
							WHERE id_Promo = $id 
							AND Carte.id_Etudiant = Etudiant.id",'Coac\Table\Carte');
	}

	static function getFromId($id)
    {
        $db = new \Coac\Database('COAC2016');
        return $db->query('SELECT * FROM Carte WHERE id_Etudiant = ' . $_GET['id'], '\Coac\Table\Carte');
    }

    static function getFromIdCarte($id)
    {
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT * FROM Carte WHERE id = $id", "\Coac\Table\Carte");
    }

    public static function edit($id, $num_carte, $etat){
    	$db = new \Coac\Database('COAC2016');
    	$db->query("UPDATE Carte SET Num_Carte = '$num_carte',
                                       		Etat = '$etat' WHERE id_Etudiant = '$id'", '\Coac\Table\Carte');
    }

    public static function add($eleve_id, $num_carte, $etat){
    	$db = new \Coac\Database('COAC2016');

        $db->query("INSERT INTO Carte VALUES (NULL, '$etat', '$num_carte', '$eleve_id') ", '\Coac\Table\Carte');

    }

    public static function carteButton($id){
        $html = "<a href='?p=pdf.carte&id=" . $id . "' />";
        $html .= "<img src='img/logoCarte.jpg' border='0' width='20' height='20' value='75'>";
        return $html .= "</a>";
    }

    public static function modif_etat($id, $etat){
        $db = new \Coac\Database('COAC2016');
        $db->query("UPDATE Carte SET Etat = '$etat' WHERE id = $id", 'Coac\Table\Carte');
    }

    public static function deleteButton($id, $idCarte){
        $db = new \Coac\Database('COAC2016');
		$name = $db->query("SELECT Nom,Prenom,id FROM Etudiant WHERE id = " . $id, '\Coac\Table\Eleve');
        $etat = "non_autorise" ;
        $html = "<a href='?p=carte.statut&id=" . $idCarte . "& etat=" .$etat. "' ";
        $html .= "onclick=\"return(confirm('Voulez vous ne pas autoriser la carte de :\\n\\n" . $name[0]->Nom . " " . $name[0]->Prenom/* . $liste->Nom $liste->prenom*/ . "'));\">";
        $html .= "<img src='img/supprime.png' border='0' width='20' height='20' value=" /* . $liste->id*/ . "  name ='suppr' />";
        return $html .= "</a>";
    }


    public static function autoriseButton($id, $idCarte){
        $db = new \Coac\Database('COAC2016');
        $name = $db->query("SELECT Nom,Prenom,id FROM Etudiant WHERE id = " . $id, '\Coac\Table\Eleve');
        $etat = "autorise" ;
        $html = "<a href='?p=carte.statut&id=" . $idCarte . "& etat=" .$etat. "' ";
        $html .= "onclick=\"return(confirm('Voulez vous autoriser la carte de :\\n\\n" . $name[0]->Nom . " " . $name[0]->Prenom/* . $liste->Nom $liste->prenom*/ . "'));\">";
        $html .= "<img src='img/autorise.png' border='0' width='20' height='20' value=" /* . $liste->id*/ . "  name ='suppr' />";
        return $html .= "</a>";
    }


    public static function perduButton($id, $idCarte){
        $db = new \Coac\Database('COAC2016');
        $name = $db->query("SELECT Nom,Prenom,id FROM Etudiant WHERE id = " . $id, '\Coac\Table\Eleve');
        $etat = "desactive" ;
        $html = "<a href='?p=carte.statut&id=" . $idCarte . "& etat=" .$etat. "' ";
        $html .= "onclick=\"return(confirm('Voulez vous désactiver la carte de :\\n\\n" . $name[0]->Nom . " " . $name[0]->Prenom/* . $liste->Nom $liste->prenom*/ . "'));\">";
        $html .= "<img src='img/lost.png' border='0' width='20' height='20' value=" /* . $liste->id*/ . "  name ='suppr' />";
        return $html .= "</a>";
    }

}