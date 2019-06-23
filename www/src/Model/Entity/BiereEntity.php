<?php
namespace App\Model\Entity;
use \Core\Controller\Helpers\TextController;
use \Core\Model\Entity;
/**
 *  Classe Biere : une bière 
 **/
class BiereEntity extends Entity
{
    private $id;
    private $nom;
    private $image;
    private $description;
    private $categories = [];
    private $prixht;

    /**
     *  id
     *  @return int
     **/
    public function getId(): int
    {
        return ($this->id);
    }

    /**
     *  nom
     *  @return string
     **/
    public function getNom()
    {
        return ((string)$this->nom);
    }

    /**
     *  slug
     *  @return string
     **/
    public function getSlug(): string
    {
        return ($this->nom);
    }
    /**
     *  image
     *  @return string
     **/
    public function getImage()
    {
        return ((string)$this->image);
    }

    /**
     *  contenu
     *  @return string
     **/
    public function getDescription()
    {
        return ((string)$this->description);
    }

    /**
     *  prix
     *  @return float
     **/
    public function getPrixht()
    {
        return ((float)$this->prixht);
    }

    /**
     *  prix
     *  @return string
     **/
    public function getPrix()
    {
        return (String)number_format($this->prixht,2,',',' ').'€';
    }
    
     /**
     *  prix
     *  @return string
     **/
    public function getPrixTTC()
    {
        return (String)number_format($this->prixht*1.2,2,',',' ').'€';
    }
    /**
     *  contenu
     *  @return string
     **/
    public function getExcerpt(int $lg = 100):string
    {
        return TextController::excerpt($this->description, $lg);
    }
    /**
     *  catégories du Biere
     *  @return string
     **/
    public function getCategories():Array
    {
        return $this->categories;
    }
    /**
     *  catégories du Biere
     *  @return string
     **/
    public function setCategories(Array $categories)
    {
        $this->categories = $categories;
    }
    /**
     *  catégories du Biere
     *  @return string
     **/
    public function setCategory(CategoryEntity $category)
    {
        $this->categories[] = $category;
    }

    /**
     * getUrl()
     */
    public function getUrl():string
    {
        return \App\App::getInstance()
            ->getRouter()
            ->url('Biere', [
            'slug' => $this->getSlug(),
            'id' => $this->getId()
        ]);
    }
}
