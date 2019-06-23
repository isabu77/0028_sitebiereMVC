<?php
namespace App\Model\Entity;
use Core\Model\Entity;

/**
 *  Classe Commandes : une commande de bières
 **/
class CommandesEntity extends Entity
{
    private $id;
    private $iduser;
    private $idsproduits;
    private $prixttc;

    /**
     *  id
     *  @return int
     **/
    public function getId(): int
    {
        return ($this->id);
    }

    /**
     *  id
     *  @return int
     **/
    public function getIduser(): int
    {
        return ($this->iduser);
    }

    /**
     *  idsproduits
     *  @return string
     **/
    public function getIdsproduits(): string
    {
        return ((string)unserialize($this->idsproduits));
    }

    /**
     *  prixttc
     *  @return string
     **/
    public function getPrixttc(): string
    {
        return (String)number_format($this->prixttc, 2,',',' ') . ' €';
    }

    /**
     *  slug
     *  @return string
     **/
    public function getSlug(): string
    {
        return ($this->idsproduits);
    }
    /**
     * getUrl()
     */
    public function getUrl():string
    {
        return \App\App::getInstance()
            ->getRouter()
            ->url('commandes', [
            'slug' => $this->getSlug(),
            'id' => $this->getId()
        ]);
    }
}
