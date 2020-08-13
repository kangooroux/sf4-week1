<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     * @Route("/", name="homepage")
     */
    public function homepage(ProduitRepository $produitRepository)
    {
        // Action                                       méthode         si résultats    si aucun résultat
        // Récupérer toutes les entités                 findAll()       array           array (vide)
        // Récupérer des entités selon des critères     findBy()        array           array (vide)
        // Récupérer 1 entité selon des critères        findOneBy()     object          null
        // Récupérer 1 entité selon son ID              find()          object          null

        //Récupère toutes les entités  //findAll()
        $findAll = $produitRepository->findAll();
        //Récupère des entités selon des crittères  //findBy()
        $findBy = $produitRepository->findBy(['description' => null],['quantite' => 'DESC']);
        //Récupère une entité selon des critères  //findOneBy()
        $findOneBy = $produitRepository->findOneBy(['description' => null],['quantite' => 'ASC']);
        //Récupère une entité selon son id  //find()
        $find42 = $produitRepository->find(42);
        //Essaie de récupérer une entité qui n'éxiste pas
        $find999 = $produitRepository->find(999);


        dump($findAll);
        dump($findBy);
        dump($findOneBy);
        dump($find42);
        dump($find999);




        dd($produitRepository);
        //Afficher le template twig home.html.twig
        return $this->render('home.html.twig', [
            'army' => 'Space Marine',
            'army2' => 'Chaos',
            'boolean' => true,
            'units' => ['HQ', 'Troops', 'Elites', 'Fast Attack', 'Heavy Support'],

        ]);
    }
    
    /**
     * @param int $id
     * @Route("/home/{id<\d+>}", name="home")
     */
    //@Route("/home/{id<\d+>}", name="home") <- regex pour vérifier que l'id est un entier
    //@Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"}) <- regex pour vérifier que l'id est un entier
    public function index($id, Request $request, SessionInterface $session)
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
            'id' => $id,
            'get' => $request->query->get('nuke', 'default') ,
            'session' => get_class($session),
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(EntityManagerInterface $em)
    {
        // Création d'une instance de Produit
        $produit = new Produit();
        dump($produit);

        //Methode-chaining
        $produit
            ->setNom('Jeans')
            ->setDescription('De couleur bleu')
            ->setPrix('29.99')
            ->setQuantite(10)
        ;
        dump($produit);

        //insertion en base
        $em->persist($produit); // on prépare l'insertion
        $em->flush(); // on enregistre en base
        dump($produit);

        //modification
        $produit->setDescription(null);
        $em->flush();
        dump($produit);

        //suppression

        $em->remove($produit); // on prépare à la supression
        $em->flush();
        dd($produit);
    }
}
