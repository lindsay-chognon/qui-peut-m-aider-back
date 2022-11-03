<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Categorie;
use App\Entity\Disponibilites;
use App\Entity\Prestation;
use App\Entity\User;
use App\Entity\Utilisateur;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        // Création de users "normaux"
        $users = Array();

        for ($i = 0; $i < 12; $i++) {
            $users[$i] = new User();
            $users[$i]->setEmail("user".$i."@quipeutmaider.com");
            $users[$i]->setRoles(["ROLE_USER"]);
            $users[$i]->setPassword($this->userPasswordHasher->hashPassword($users[$i], "password".$i));
            $manager->persist($users[$i]);
        }


        // Création d'un user admin

        $userAdmin = new User();
        $userAdmin->setEmail("admin@quipeutmaider.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "password"));
        $manager->persist($userAdmin);

        $faker = Faker\Factory::create('fr_FR');

        // Création de villes
        $villes = Array();

        for ($i = 0; $i < 12; $i++) {

            $villes[$i] = new Ville();
            $villes[$i]->setVille($faker->city);
            $villes[$i]->setCodePostal($faker->numberBetween(10000, 90000));
            $villes[$i]->setCodeCommune($faker->numberBetween(10000, 90000));

            $manager->persist($villes[$i]);
        }

        // Création de catégories
        $categories = Array();

        for ($i = 0; $i < 12; $i++) {

            $categories[$i] = new Categorie();
            $categories[$i]->setNom($faker->word);

            $manager->persist($categories[$i]);
        }

        // Création de prestations
        $prestations = Array();

        for ($i = 0; $i < 12; $i++) {
            $prestations[$i] = new Prestation();
            $prestations[$i]->setTitre($faker->word);
            $prestations[$i]->setDescription($faker->word);
            $prestations[$i]->setPhoto($faker->word);
            $prestations[$i]->setTauxHoraire($faker->numberBetween(10, 100));
            $prestations[$i]->setStatut(1);
            $prestations[$i]->setCategorie($categories[$faker->numberBetween(1, 11)]);
            $prestations[$i]->setVille($villes[$faker->numberBetween(1, 11)]);

            $manager->persist($prestations[$i]);
        }

        // Création d'utilisateurs
        $utilisateurs = Array();

        for ($i = 0; $i < 12; $i++) {
            $utilisateurs[$i] = new Utilisateur();
            $utilisateurs[$i]->setEmail($faker->email);
            $utilisateurs[$i]->setLogin($faker->word);
            $utilisateurs[$i]->setPassword($faker->word);
            $utilisateurs[$i]->setNom($faker->lastName);
            $utilisateurs[$i]->setPrenom($faker->name);
            $utilisateurs[$i]->setDateNaissance($faker->dateTimeThisCentury);
            $utilisateurs[$i]->setPhoto($faker->image());
            $utilisateurs[$i]->setTelephone($faker->phoneNumber);
            $utilisateurs[$i]->setGroupeUtilisateur(1);

            $manager->persist($utilisateurs[$i]);
        }

        // Création d'adresses
        $adresses = Array();

        for ($i = 0; $i < 12; $i++) {
            $adresses[$i] = new Adresse();
            $adresses[$i]->setUtilisateur($utilisateurs[$i]);
            $adresses[$i]->setVille($villes[$faker->numberBetween(1, 11)]);
            $adresses[$i]->setAdresse($faker->streetAddress);

            $manager->persist($adresses[$i]);
        }

        // Création de disponibilités
        $dispos = Array();

        for ($i = 0; $i < 12; $i++) {
            $dispos[$i] = new Disponibilites();
            $dispos[$i]->setDatetimeDebut($faker->dateTimeBetween('+10 days', '+14 days'));
            $dispos[$i]->setDatetimeFin($faker->dateTimeBetween('+14 days', '+18 days'));
            $dispos[$i]->setPrestation($prestations[$i]);

            $manager->persist($dispos[$i]);
        }

        $manager->flush();
    }
}
