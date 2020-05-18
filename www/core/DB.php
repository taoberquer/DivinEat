<?php
namespace App\core;
use App\core\PDOSingleton;

class DB
{
    private $table;
    private $pdo;

    public function __construct()
    {
        //SINGLETON
        try {
            $this->pdo = PDOSingleton::getInstance();
        } catch (Exception $e) {
            die("Erreur SQL : ".$e->getMessage());
        }

        $this->table =  DB_PREFIXE.get_called_class();
    }

    public function hydrate(array $donnees){
        foreach($donnees as $key => $value){
            $method = 'set'.ucfirst(strtolower($key));
        
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function save()
    {
        $propChild = get_object_vars($this);
        $propDB = get_class_vars(get_class());

        $columnsData = array_diff_key($propChild, $propDB);
        $columns = array_keys($columnsData);

        
        if (!is_numeric($this->id)) {
            
            //INSERT
            $sql = "INSERT INTO ".$this->table." (".implode(",", $columns).") VALUES (:".implode(",:", $columns).");";
        } else {

            //UPDATE
            foreach ($columns as $column) {
                $sqlUpdate[] = $column."=:".$column;
            }

            $sql = "UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id;";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($columnsData);
    }
}