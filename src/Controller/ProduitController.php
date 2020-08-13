<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * On définit un préfixe pour les URIs et nome de route pour ce controller
 * @Route("/produit", name="produit_")
 */
class ProduitController extends AbstractController
{
    /**
     * Liste des produit
     *      URI:/produit/
     *      name:produit_list
     * @Route("/", name="list")
     */
    public function index(ProduitRepository $produitRepository)
    {
        return $this->render('produit/index.html.twig', [
            'liste_produits' => $produitRepository->findAll(),
        ]);
    }
}
