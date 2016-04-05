<?php
namespace Coac\Table;

/**
* 
*/
class Log
{
    public static function getAll(){
        $db = new \Coac\Database();
        return $db->query("SELECT Etudiant.Nom as Nom_Etudiant, Prenom, Promo.Nom as Nom_Promo,  Journalisation.Date, Evenement 
                        FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id
                        ORDER BY Journalisation.Date DESC");
    }

	public static function select(){
        $db = new \Coac\Database();
        return $db->query("SELECT DISTINCT Etudiant.Nom, Etudiant.id,Prenom, Promo.Nom as Nom_Promo, id_Promo 
                        FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id");
    }


    public static function selectEleveWithClasse($idClasse){
        $db = new \Coac\Database();
        return $db->query("SELECT DISTINCT Etudiant.Nom, Etudiant.id , Prenom, Promo.Nom as Nom_Promo, id_Promo FROM Journalisation,Etudiant,Promo
                        WHERE  Etudiant.id =  Journalisation.id_etudiant
                        AND Etudiant.id_Promo = Promo.id
                        AND Etudiant.id_Promo = ?", [$idClasse]);
    }

    public static function getAllWithId($idEleve){
        $db = new \Coac\Database();
        return $db->query("SELECT Etudiant.Nom as Nom_Etudiant, Prenom, Promo.Nom as Nom_Promo,  Journalisation.Date, Evenement 
                        FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id
        				AND Etudiant.id = ?
                        ORDER BY Journalisation.Date DESC", [$idEleve]);
    }


    public static function getAllWithIdClasse($idClasse){
        $db = new \Coac\Database();
        return $db->query("SELECT Etudiant.Nom as Nom_Etudiant, Prenom, Promo.Nom as Nom_Promo, Journalisation.Date, Evenement 
                        FROM Journalisation,Etudiant,Promo, Carte
                        WHERE  Etudiant.id =  Journalisation.id_Etudiant
                        AND Etudiant.id_Promo = Promo.id
                        AND Promo.id = ?
                        ORDER BY Journalisation.Date DESC", [$idClasse]);
    }


    public static function eleve_add($id, $nom, $prenom, $classe, $num_carte){
        $db = new \Coac\Database();

        $evenement = "Ajout de l'élève $nom $prenom" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, ?, ?, NOW(), ?)", [$id, $num_carte, $evenement]);

    }

    public static function eleve_delete($id){
        $db = new \Coac\Database();
        $evenement = "Suppression d'un élève" ;
        $num_carte = $db->query("SELECT Num_Carte FROM Etudiant, Carte WHERE Etudiant.id = Carte.id_Etudiant")->fetch();

        $db->query("INSERT INTO Journalisation VALUES (NULL, ?, ?, NOW(), ?)", [$id, $num_carte->Num_Carte, $evenement]);

    }

    public static function eleve_edit($id, $num_carte){
        $db = new \Coac\Database();

        $evenement = "Modification des informations d'un élève" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, ?, ?, NOW(), ?)", [$id, $num_carte, $evenement]);

    }

    public static function promos_add($name){
        $db = new \Coac\Database();

        $evenement = "Ajout de la classe $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function promos_delete($id){
        $db = new \Coac\Database();

        $name = $db->query("SELECT Nom FROM Promo WHERE id = ?", [$id]);
        $evenement = "Suppression de la classe $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function promos_edit($name_anc, $name_new){
        $db = new \Coac\Database();

        $evenement = "Modification du nom de la classe $name_anc en $name_new" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function lycee_add($name){
        $db = new \Coac\Database();

        $evenement = "Ajout du lycee $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);
    }

    public static function lycee_edit($name_anc, $name_new){
        $db = new \Coac\Database();

        $evenement = "Modification du lycee $name_anc en $name_new" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);
    }

    public static function lycee_delete($name){
        $db = new \Coac\Database();

        $evenement = "Suppression du lycee $name ";

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);
    }

    public static function carte_add($id, $num_carte){
        $db = new \Coac\Database();

        $data = $db->query("SELECT Nom,Prenom FROM Etudiant WHERE id = ?", [$id])->fetch();
        $nom = $data->Nom;
        $prenom = $data->Prenom;

        var_dump($nom);
        var_dump($prenom);

        $evenement = "Ajout d'une carte appartenant à $prenom $nom ";

        $db->query("INSERT INTO Journalisation VALUES (NULL, ?, ?, NOW(), ?)", [$id, $num_carte, $evenement]);

    }

    public static function carte_statut($id, $num_carte, $prenom, $nom){
        $db = new \Coac\Database();

        $evenement = "Modification de l'état de la carte appartenant à l'élève $prenom $nom ";

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);

    }


    public static function salle_add($name){
        $db = new \Coac\Database();

        $evenement = "Ajout de la salle $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function salle_edit($name_anc, $name_new){
        $db = new \Coac\Database();

        $evenement = "Modification du nom de la salle $name_anc en $name_new" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, NOW(), ?)", [$evenement]);

    }

}