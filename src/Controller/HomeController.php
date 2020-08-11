<?php

namespace App\Controller;

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
            'units' => ['HQ', 'Troops', 'Elites', 'Fast Attack', 'Heavy Support']
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
}
