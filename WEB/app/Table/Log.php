<?php
namespace Coac\Table;

/**
* 
*/
class Log
{
    public static function getAll(){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT Etudiant.Nom as Nom_Etudiant, Prenom, Promo.Nom as Nom_Promo, Journalisation.Date, Evenement FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id", 'Coac\Table\Log');
    }

	public static function select(){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT DISTINCT Etudiant.Nom, Etudiant.id,Prenom, Promo.Nom as Nom_Promo, id_Promo FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id", 'Coac\Table\Log');
    }


    public static function selectEleveWithClasse($idClasse){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT DISTINCT Etudiant.Nom, Etudiant.id , Prenom, Promo.Nom as Nom_Promo, id_Promo FROM Journalisation,Etudiant,Promo
                        WHERE  Etudiant.id =  Journalisation.id_etudiant
                        AND Etudiant.id_Promo = Promo.id
                        AND Etudiant.id_Promo = $idClasse", 'Coac\Table\Log');
    }

    public static function getAllWithId($idEleve){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT Etudiant.Nom as Nom_Etudiant, Prenom, Promo.Nom as Nom_Promo, Journalisation.Date, Evenement FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id
        				AND Etudiant.id = $idEleve", 'Coac\Table\Log');
    }


    public static function getAllWithIdClasse($idClasse){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT Etudiant.Nom as Nom_Etudiant, Prenom, Promo.Nom as Nom_Promo, Journalisation.Date, Evenement FROM Journalisation,Etudiant,Promo
                        WHERE  Etudiant.id =  Journalisation.id_Etudiant
                        AND Etudiant.id_Promo = Promo.id
                        AND Promo.id = $idClasse", 'Coac\Table\Log');
    }


    public static function eleve_add($id, $nom, $prenom, $classe, $num_carte){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Ajout d'un élève" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, $id, $num_carte, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function eleve_delete($id){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Suppression d'un élève" ;
        $num_carte = $db->query("SELECT Num_Carte FROM Etudiant.Carte WHERE Etudiant.id = Carte.id_Etudiant", 'Coac\Table\Log');

        return $db->query("INSERT INTO Journalisation VALUES (NULL, $id, $num_carte, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function eleve_edit($id, $num_carte){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Modification des informations d'un élève" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, $id, $num_carte, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function promos_add($name){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Ajout de la classe $name" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function promos_delete($id){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $name = $db->query("SELECT Nom FROM Promo WHERE id = $id", 'Coac\Table\Log');
        $evenement = "Suppression de la classe $name" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function promos_edit($name){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Modification des informations de la classe $name" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function lycee_add($name){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Ajout du lycee $name" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function lycee_delete($name){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Suppression du lycee $name" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function carte_add($id, $num_carte){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Ajout d'une carte appartenant à $prenom $nom" ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, $id, $num_carte, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function carte_statut($id, $num_carte, $prenom, $nom){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Modification de l'état de la carte appartenant à l'élève" . $prenom ." ". $nom;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }


    public static function salle_add($nom){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Ajout de la salle" .$name ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }

    public static function salle_edit($name){
        $db = new \Coac\Database('COAC2016');

        $date = time(Y-m-d);
        $evenement = "Modification des informations de la salle" .$name ;

        return $db->query("INSERT INTO Journalisation VALUES (NULL, NULL, NULL, $date, $evenement)", 'Coac\Table\Log');

    }

}