<?php

namespace App\Controller;

use App\Form\ProduitFormType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajout(Request $request, EntityManagerInterface $entityManager)
    {
        // 1) Création du formulaire
        $form = $this->createForm(ProduitFormType::class);

        // 2) Passer la requète post HTTP au formulaire (récupérer les données envoyées)
        $form->handleRequest($request);

        // 3) Vérifier que le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) Récupéré les données du formulaire
            $produit = $form->getData();

            $entityManager->persist($produit);
            $entityManager->flush();

            // Message flash & redirection
            $this->addFlash('success', 'le produit a été enregistré !');
            return $this->redirectToRoute('produit_list');
        }



        return $this->render('produit/ajout.html.twig', [
            'produit_form' => $form->createView(),
        ]);
    }
}
