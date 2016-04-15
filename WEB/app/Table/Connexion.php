<?php
namespace
 Coac\Table;


/**
* 
*/

class Connexion
{


public static function getAll(){

        $db = new \Coac\Database();

        return $db->query("SELECT * FROM Connexion ");
        
    }

public static function verif($identifiant){

        $db = new \Coac\Database();

        return $db->query("SELECT * FROM Connexion WHERE Identifiant = ? ", [$identifiant]);
        
    }

    public static function add($identifiant, $mdp){

        $db = new \Coac\Database();

        if($db->query("INSERT INTO Connexion VALUES (NULL, ?, ?) ", [$identifiant, $mdp])){

        return true ;
        }

        return false ;
        
    }

   


}