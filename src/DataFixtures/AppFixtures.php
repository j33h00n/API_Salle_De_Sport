<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Users;
use App\Entity\Franchises;
use App\Entity\Modules;
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
        $users = [];
        for ($i = 0; $i < 120; $i++) {

            $user = new Users();
            $user->setEmail($this->faker->email)
                ->setRoles(['ROLE_USER'])
                ->setPassword(password_hash('Bonjour1', PASSWORD_BCRYPT))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setIsVerified(true);
            $users[] = $user;
            $manager->persist($user);
        }

        //Creation ADMINISTRATEUR
        $user = new Users();
        $user->setEmail('admin@admin.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(password_hash('admin', PASSWORD_BCRYPT))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setIsVerified(true);

        $manager->persist($user);

        //Creation utilisateur Franchises
        $user = new Users();
        $user->setEmail('franchises@orangebleue.com')
            ->setRoles(['ROLE_FRANC'])
            ->setPassword(password_hash('bonjour1', PASSWORD_BCRYPT))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setIsVerified(true);

        $manager->persist($user);

        //Creation utilisateur Structures
        $user = new Users();
        $user->setEmail('structures@orangebleue.com')
            ->setRoles(['ROLE_STRUC'])
            ->setPassword(password_hash('bonjour1', PASSWORD_BCRYPT))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setIsVerified(true);

        $manager->persist($user);

        //Creation des modules
        $modules = new Modules();
        $modules->setName('Gerer planning equipe')
            ->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($modules);

        $modules = new Modules();
        $modules->setName('Envoyer newsletter')
            ->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($modules);

        $modules = new Modules();
        $modules->setName('Vendre des boissons')
            ->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($modules);

        $modules = new Modules();
        $modules->setName('Cours Fitness personnalisé')
            ->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($modules);


        //Creation de Franchises
        $franchisesf = [];
        for ($j = 0; $j < 4; $j++) {

            $franchises = new Franchises();
            $franchises->setVille($this->faker->city)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUser($users[mt_rand(0, 120)]);

            $franchisesf[] = $franchises;       
            $manager->persist($franchises);
        }

        //Creation des Structures pour chaque Franchise
        for ($k = 0; $k < 10; $k++) {

            $structure = new Structures();
            $structure->setAdresse($this->faker->streetAddress)
                ->setUser($users[mt_rand(0, 120)])
                ->setIsActive(true)
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($structure);
        }
        



        //Creation de permissions



        $manager->flush();
    }
}
