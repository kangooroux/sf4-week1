<?php

namespace App\Controller;

use App\Entity\Produit;
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
    public function homepage()
    {
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
