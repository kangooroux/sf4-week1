<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home/{id<\d+>}", name="home")
     */
    //@Route("/home/{id<\d+>}", name="home") <- regex pour vérifier que l'id est un entier
    //@Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"}) <- regex pour vérifier que l'id est un entier
    public function index($id)
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
            'id' => $id,
        ]);
    }
}
