<?php
namespace Coac\Table;

/**
* 
*/
class Salle
{

	public static function getAll(){
        $db = new \Coac\Database('COAC2016');
        return $db->query("SELECT id,Nom FROM Salle", 'Coac\Table\Salle');
    }

	public static function add($nom){
        $db = new \Coac\Database('COAC2016');
        return $db->query("INSERT INTO Salle VALUES (NULL, '$nom')", 'Coac\Table\Salle');

    }

    static function getFromId($id)
    {
        $db = new \Coac\Database('COAC2016');
        return $db->query('SELECT * FROM Salle WHERE id = ' . $_GET['id'], '\Coac\Table\Salle');
    }

    public static function edit($id, $name){
        $db = new \Coac\Database('COAC2016');
        return $db->query("UPDATE Salle SET     Nom = '$name' WHERE id = '$id' ", '\Coac\Table\Salle');
    }

    public static function delete($id){
        $db = new \Coac\Database('COAC2016');
        return $db->query("DELETE FROM Salle WHERE id = $id", 'Coac\Table\Salle');
    }




    public static function editButton($id){
        $html = "<a href='?p=salle.edit&id=" . $id . "' />";
        $html .= "<img src='img/modif.png' border='0' width='20' height='20' value='75'>";
        return $html .= "</a>";
    }

    public static function deleteButton($id, $nom){
        $db = new \Coac\Database('COAC2016');
        $html = "<a href='?p=salle.delete&id=" . $id . "' ";
        $html .= "onclick=\"return(confirm('Confirmer la suppression de :\\n\\n" . $nom/* . $liste->Nom $liste->prenom*/ . "'));\">";
        $html .= "<img src='img/supprime.png' border='0' width='20' height='20' value=" /* . $liste->id*/ . "  name ='suppr' />";
        return $html .= "</a>";
    }

}