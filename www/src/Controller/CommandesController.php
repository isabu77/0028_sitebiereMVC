<?php
namespace App\Controller;
use \Core\Controller\Controller;
use App\Controller\PaginatedQueryAppController;

class CommandesController extends Controller
{
    /**
     * constructeur par Correction AFORMAC
     */
    public function __construct()
    {
        // crée une instance de la classe PostTable dans la propriété $this->post
        // $this->commandes est créée dynamiquement
        $this->loadModel('commandes');    
        
        // $this->post est créée dynamiquement pour accéder aux méthodes de PostTable
        // via PaginatedQueryController pour afficher les posts d'une catégorie
        $this->loadModel('biere');
    }

    /**
     * toutes les catégories
     */
    public function all(int $iduser = null)
    {
        //==============================  correction AFORMAC
        // $this->post contient une instance de la classe PostTable
        $paginatedQuery = new PaginatedQueryAppController(
            $this->commandes,
            $this->generateUrl('commandes')
        );
        $commandes = $paginatedQuery->getItemsInId($iduser);

        $title = "Commandes";

        // affichage HTML avec commandes/all.twig
        $this->render('commandes/all', [
            'commandes' => $commandes,
            'paginate' => $paginatedQuery->getNavHTML(),
            'title' => $title
        ]);
    }

    /**
     * une seule commande et ses bières
     */
    public function show(string $slug, int $id)
    {
        // méthode générique de table.php
        $commandes = $this->commandes->find($id);

        if (!$commandes) {
            throw new \exception("Aucune commandes ne correspond à cet Id");
        }
        if ($commandes->getSlug() !== $slug) {
            $url = $this->generateUrl('commandes', ['id' => $id, 'slug' => $commandes->getSlug()]);
            // code 301 : redirection permanente pour le navigateur (de son cache, plus de requete au serveur)
            http_response_code(301);
            header('Location:' . $url);
            exit();
        }

        $title = 'Commande : ' . $commandes->getName();

        // les articles de la catégorie : 
        // $this->post doit etre créé par loadModel dans le constructeur
        $paginatedQuery = new PaginatedQueryAppController(
            $this->post,
            $this->generateUrl('commandes', ["id" => $commandes->getId(), "slug" => $commandes->getSlug()])
        );
        $postById = $paginatedQuery->getItemsInId($id);

        $this->render(
            "commandes/show",
            [
                "title" => $title,
                "bieres" => $postById,
                "paginate" => $paginatedQuery->getNavHTML()
            ]
        );

    }
}
