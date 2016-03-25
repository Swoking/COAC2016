<?php
namespace Coac\Table;

/**
* 
*/
class Log
{
    public static function getAll(){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT * FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id", 'Coac\Table\Log');
    }

	public static function select(){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT DISTINCT Etudiant.Nom,Etudiant.id,Prenom,Promo.Nom as Nom_Promo, id_Promo FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id", 'Coac\Table\Log');
    }


    public static function selectEleveWithClasse($idClasse){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT DISTINCT Etudiant.Nom,id,Prenom,Promo.Nom as Nom_Promo, id_Promo FROM Journalisation,Etudiant,Promo
                        WHERE  Etudiant.id =  Journalisation.id_etudiant
                        AND Etudiant.id_Promo = Promo.id
                        AND Etudiant.id_Promo = $idClasse", 'Coac\Table\Log');
    }

    public static function getAllWithId($idEleve){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT * FROM Journalisation,Etudiant,Promo
        				WHERE  Etudiant.id =  Journalisation.id_Etudiant
        				AND Etudiant.id_Promo = Promo.id
        				AND Etudiant.id = $idEleve", 'Coac\Table\Log');
    }


    public static function getAllWithIdClasse($idClasse){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT * FROM Journalisation,Etudiant,Promo
                        WHERE  Etudiant.id =  Journalisation.id_Etudiant
                        AND Etudiant.id_Promo = Promo.id
                        AND Promo.id = $idClasse", 'Coac\Table\Log');
    }
}