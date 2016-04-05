<?php
namespace Coac;
use \PDO;
/**
 *
 */
class Database{

  private $pdo;

  function __construct(){
    $this->pdo = new PDO('mysql:dbname=COAC2016;host=127.0.0.1', 'root', 'root');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  }

  /**
   * @param $query
   * @param bool|array $params
   * @return PDOStatement
    */
  public function query($query, $params = false){
    if($params){
      $req = $this->pdo->prepare($query);
      $req->execute($params);
    } else {
      $req = $this->pdo->query($query);
    }
    return $req;
  }

  public function lastInsertId(){
    return $this->pdo->lastInsertId();
  }

}

