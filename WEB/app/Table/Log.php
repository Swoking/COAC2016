<?php
namespace Coac\Table;

/**
* 
*/
class Log
{
    public static function getAll(){
        $db = new \Coac\Database();
        return $db->query("SELECT Journalisation.Date, Evenement 
                        FROM Journalisation
                        ORDER BY Journalisation.Date DESC");
    }

    public static function getAllWithRechercher($rechercher){
        $db = new \Coac\Database();

        $rechercher = "%$rechercher%";
        
        return $db->query("SELECT Journalisation.Date, Evenement 
                        FROM Journalisation
        				WHERE Evenement LIKE ?
                        ORDER BY Journalisation.Date DESC", [$rechercher]);
    }



    public static function eleve_add($nom, $prenom){
        $db = new \Coac\Database();

        $evenement = "Ajout de l'élève $nom $prenom" ;//num_carte

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function eleve_delete($nom, $prenom){
        $db = new \Coac\Database();
        $evenement = "Suppression de l'élève $nom $prenom" ; //ici

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function eleve_edit($nom , $prenom){
        $db = new \Coac\Database();

        $evenement = "Modification des informations de l'élève $nom $prenom" ; //ici //num_carte

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function promos_add($name){
        $db = new \Coac\Database();

        $evenement = "Ajout de la classe $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function promos_delete($id){
        $db = new \Coac\Database();

        $name = $db->query("SELECT Nom FROM Promo WHERE id = ?", [$id])->fetch();
        $evenement = "Suppression de la classe $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function promos_edit($name_anc, $name_new){
        $db = new \Coac\Database();

        $evenement = "Modification du nom de la classe $name_anc en $name_new" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function lycee_add($name){
        $db = new \Coac\Database();

        $evenement = "Ajout du lycee $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);
    }

    public static function lycee_edit($name_anc, $name_new){
        $db = new \Coac\Database();

        $evenement = "Modification du lycee $name_anc en $name_new" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);
    }

    public static function lycee_delete($name){
        $db = new \Coac\Database();

        $evenement = "Suppression du lycee $name ";

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);
    }

    public static function carte_add($id){
        $db = new \Coac\Database();

        $data = $db->query("SELECT Nom,Prenom FROM Etudiant WHERE id = ?", [$id])->fetch();
        $nom = $data->Nom;
        $prenom = $data->Prenom;

        $evenement = "Ajout d'une carte appartenant à $nom $prenom "; //num_carte

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function carte_statut($num_carte, $prenom, $nom){
        $db = new \Coac\Database();

        $evenement = "Modification de l'état de la carte appartenant à l'élève $nom $prenom ";

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

        public static function carte_rendue($nom, $prenom){
        $db = new \Coac\Database();

        $evenement = "La carte de l'élève $nom $prenom a été rendue";

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }


    public static function salle_add($name){
        $db = new \Coac\Database();

        $evenement = "Ajout de la salle $name" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function salle_edit($name_anc, $name_new){
        $db = new \Coac\Database();

        $evenement = "Modification du nom de la salle $name_anc en $name_new" ;

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);

    }

    public static function salle_delete($name){
        $db = new \Coac\Database();

        $evenement = "Suppression de la salle $name ";

        $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NOW(), ?)", [$evenement]);
    }
}