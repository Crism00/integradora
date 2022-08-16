<?php
namespace barber\Query;
use PDO;
use PDOException;
use barber\Data\Database;

class ejecuta
{
    public function ejecutar($qry)
    {
        try 
        {
            $cc = new Database("barberia","root","admin");
            $objetoPDO= $cc->getPDO();
            $resultado= $objetoPDO->query($qry);
            $fila = $resultado->fetchAll(PDO::FETCH_OBJ);            
            $cc->desconectarDB();
            return $fila;
            
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
    }
}