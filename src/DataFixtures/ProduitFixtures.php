<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Instanciation de  Faker
        $faker = Factory::create('fr_FR');

        // Génération de 50 entrées Produits
        for ($i=0; $i < 50; $i++) {
            //Générer un produit sans oublier persist() !
            $produit = (new Produit())
                ->setNom($faker->realText(50))
                ->setDescription($faker->optional(0.5)->realText(200))
                ->setQuantite($faker->numberBetween(0, 100))
                ->setPrix($faker->regexify('^[1-9]{1}\d{1,3}\.\d{2}$'))
            ;
            //On prépare à l'enregistrement
            $manager->persist($produit);
        }

        //Enregistrer les 50 entités en base
        $manager->flush();
    }
}
