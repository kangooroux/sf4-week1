<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Instanciation de  Faker
        $faker = Factory::create();

        // Génération de 50 entrées Produits
        for ($i=0; $i < 50; $i++) {
            //Générer un produit sans oublier persist() !

        }

        //Enregistrer les 50 entités en base

    }
}
