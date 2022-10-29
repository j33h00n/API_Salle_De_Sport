<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Users;
use App\Entity\Franchises;
use App\Entity\Structures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
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

            $user = new Users();
            $user->setEmail($this->faker->email)
                ->setRoles(['ROLE_USER'])
                ->setPassword(password_hash('admin', PASSWORD_BCRYPT))
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($user);
        }

        //Creation de Franchises et Structures
        // for ($j = 0; $j < 4; $j++) {

        //     $franchises = new Franchises();
        //     $franchises->setVille($this->faker->city)
        //         ->setUser($this->getReference('user_' . rand(1, 19)))
        //         ->setCreatedAt(new \DateTimeImmutable());

        //     $manager->persist($franchises);

        //     //Creation de Structures pour chaque Franchise
        //     for ($k = 0; $k <= mt_rand(1, 3); $k++) {
        //         $structure = new Structures();

        //         $structure->setAdresse($this->faker->streetAddress)
        //             ->setUser($this->getReference('user_' . rand(1, 19)))
        //             ->set
        //             ->setCreatedAt(new \DateTimeImmutable());

        //         $manager->persist($structure);
        //     }
        // }



        //Creation de permissions



        $manager->flush();
    }
}
