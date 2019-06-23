<?php
namespace App\Model\Table;

use \Core\Model\Table;
use App\Model\Entity\BiereEntity;

/**
 *  Classe BiereTable : accès à la table Biere 
 **/
class BiereTable extends Table
{
    /**
     * lecture de tous les articles d'une page avec leurs catégories
     */
    public function allByLimit(int $limit, int $offset)
    {

        $Bieres = $this->query("SELECT * FROM {$this->table} LIMIT {$limit} OFFSET {$offset}", null);

        $ids = array_map(function (BiereEntity $Biere) {
            return $Biere->getId();
        }, $Bieres);


        //$categories = (new CategoryTable($this->db))->allInId(implode(', ', $ids));

        $BiereById = [];
        foreach ($Bieres as $Biere) {
            $BiereById[$Biere->getId()] = $Biere;
        }
        //foreach ($categories as $category) {
        //    $BiereById[$category->Biere_id]->setCategory($category);
        //}
        return $BiereById;
    }

    /**
     * surcharge de count() pour gérer le nb d'articles d'une catégorie
     */
    public function count(?int $id = null)
    {
        if (!$id){
            // sans id : appel de la méthode de la classe parente Table.php
            return parent::count();
        }else{
            return $this->query("SELECT COUNT(id) as nbrow FROM {$this->table} as p 
                    JOIN Biere_category as pc ON pc.Biere_id = p.id 
                    WHERE pc.category_id = {$id}", null, true);
            
        }
    }
    /**
     * lecture de tous les articles d'une catégorie d'une page
     */
    public function allInIdByLimit(int $limit, int $offset, int $idCategory)
    {

        $Bieres = $this->query("
        SELECT * FROM {$this->table} as p 
                JOIN Biere_category as pc ON pc.Biere_id = p.id 
                WHERE pc.category_id = {$idCategory}
                LIMIT {$limit} OFFSET {$offset} ", null);

        $ids = array_map(function (BiereEntity $Biere) {
            return $Biere->getId();
        }, $Bieres);


        $categories = (new CategoryTable($this->db))->allInId(implode(', ', $ids));


        $BiereById = [];
        foreach ($Bieres as $Biere) {
            $BiereById[$Biere->getId()] = $Biere;
        }
        foreach ($categories as $category) {
            $BiereById[$category->Biere_id]->setCategory($category);
        }
        return $BiereById;
    }
}
