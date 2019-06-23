<?php
namespace App\Model\Table;
use \Core\Model\Table;

/**
 *  Classe CommandesTable : accès à la table commandes
 **/
class CommandesTable extends Table
{
    /**
     * surcharge de count() pour gérer le nb de commandes d'un user
     */
    public function count(int $iduser = null)
    {
        if (!$iduser){
            // sans id : appel de la méthode de la classe parente Table.php
            return parent::count();
        }else{
            return $this->query("SELECT COUNT(id) as nbrow FROM {$this->table} 
                                WHERE iduser = {$iduser}");
        }
    }
    
    /**
     * lecture de toutes les commandes d'un user par page
     */
    public function allInIdByLimit(int $limit, int $offset, int $iduser = null)
    {
        if (!$iduser){
            // sans id : appel de la méthode de la classe parente Table.php
            return parent::allByLimit($limit, $offset);
        }else{
            return $this->query("
                    SELECT * FROM {$this->table} 
                    WHERE iduser = {$iduser} LIMIT {$limit} OFFSET {$offset} ");
        }
    }
}