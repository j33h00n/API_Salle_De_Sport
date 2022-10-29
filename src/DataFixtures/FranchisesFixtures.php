<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Franchises;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FranchisesFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    
    public function load(ObjectManager $manager): void
    {
        //Creation d'utilisateurs
        for ($i = 0; $i < 20; $i++) {

            $franchises = new Franchises();
            $franchises->setVille($this->faker->city)
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($franchises);
        }


        $manager->flush();
    }
}
