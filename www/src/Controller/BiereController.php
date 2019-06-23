<?php
namespace App\Controller;

use \Core\Controller\Controller;
use App\Controller\PaginatedQueryAppController;

class BiereController extends Controller
{
    /**
     * constructeur
     */
    public function __construct()
    {
        // crée une instance de la classe BiereTable dans la propriété 
        // $this->biere qui est créée dynamiquement
        $this->loadModel('biere');

    }

    /**
     * tous les articles
     */
    public function all()
    {
        //==============================  correction AFORMAC
        // $this->Biere contient une instance de la classe BiereTable
        $paginatedQuery = new PaginatedQueryAppController(
            $this->biere,
            $this->generateUrl('home')
        );
        $BiereById = $paginatedQuery->getItems();

        $title = "Les bières d'ISA";

        $this->render('biere/all', [
            'bieres' => $BiereById,
            'paginate' => $paginatedQuery->getNavHTML(),
            'title' => $title
        ]);
    }

    /**
     * un seul article by 'lire plus'
     */
    public function show(string $slug, int $id)
    {
        // lecture de l'article dans la base (objet Biere) par son id
        $Biere = $this->Biere->find($id);

        if (!$Biere) {
            throw new \exception("Aucun article ne correspond à cet Id");
        }

        // vérifier si on est sur le bon article avec le bon slug dans les paramètres de l'url demandée
        if ($Biere->getSlug() !== $slug) {
            $url = $this->generateUrl('Biere', ['id' => $id, 'slug' => $Biere->getSlug()]);
            // code 301 : redirection permanente pour le navigateur (de son cache, plus de requete au serveur)
            http_response_code(301);
            header('Location:' . $url);
            exit();
        }

        // les catégories de l'article par CategoryTable
        $Biere->setCategories($this->category->allInId($Biere->getId()));
        $title = $Biere->getName();

        // affichage HTML avec Biere/show.twig
        $this->render('Biere/show', [
            'Biere' => $Biere,
            'title' => $title
        ]);
    }
}
