<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitFormType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * Ajout d'un produit
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


    /**
     * Modification d'un produit
     * @Route("/{id}/modifier", name="modif")
     * Le composant ParamConverter va convertir le paramètre id en l'entité associée
     *
     */
    public function modification(Produit $produit, Request $request, EntityManagerInterface $entityManager)
    {
        // On passe l'entité à modifier en 2me argument (arg. "data") pour que l'objet soit directement apporté dans le formulaire puis modifié
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // il n'est pas nécessaire de récupéré les données du formulaire: l'entité a été modifiée par celui-ci
            // On apppele pas non plus $entityManager->persist() car Doctrine connaît dèjà l'existence de l'entité
            $entityManager->flush();
            $this->addFlash('primary', 'Le produit a été mis à jour !');
        }

        return $this->render('produit/modif.html.twig', [
            'produit' => $produit,
            'produit_form' => $form->createView(),
        ]);
    }

    /**
     * Suppression d'un produit
     * @Route("/{id}/supprimer", name="supprimer")
     * Le composant ParamConverter va convertir le paramètre id en l'entité associée
     *
     */
    public function supression(Produit $produit, Request $request, EntityManagerInterface $entityManager)
    {
        //supression
        $entityManager->remove($produit);
        $entityManager->flush();

        //Message et rédirection
        $this->addFlash('danger', 'Le produit a bien été supprimé');
        return $this->redirectToRoute('produit_list');
    }
}
