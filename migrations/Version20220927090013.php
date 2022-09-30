<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927090013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, ville_id INT NOT NULL, adresse VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C35F0816FB88E14F (utilisateur_id), INDEX IDX_C35F0816A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disponibilites (id INT AUTO_INCREMENT NOT NULL, prestation_id INT NOT NULL, datetime_debut DATETIME NOT NULL, datetime_fin DATETIME NOT NULL, INDEX IDX_B0F3489C9E45C554 (prestation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jour (id INT AUTO_INCREMENT NOT NULL, prestation_id INT NOT NULL, disponibilite_id INT NOT NULL, jour_debut DATE NOT NULL, jour_fin DATE NOT NULL, INDEX IDX_DA17D9C59E45C554 (prestation_id), UNIQUE INDEX UNIQ_DA17D9C52B9D6493 (disponibilite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, ville_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, photo VARCHAR(255) DEFAULT NULL, taux_horaire DOUBLE PRECISION NOT NULL, statut INT NOT NULL, INDEX IDX_51C88FADBCF5E72D (categorie_id), INDEX IDX_51C88FADA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, prestation_id INT NOT NULL, utilisateur_id INT NOT NULL, jour DATE NOT NULL, debut TIME NOT NULL, fin TIME NOT NULL, INDEX IDX_42C849559E45C554 (prestation_id), INDEX IDX_42C84955FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, photo VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, groupe_utilisateur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE disponibilites ADD CONSTRAINT FK_B0F3489C9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE jour ADD CONSTRAINT FK_DA17D9C59E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE jour ADD CONSTRAINT FK_DA17D9C52B9D6493 FOREIGN KEY (disponibilite_id) REFERENCES disponibilites (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816FB88E14F');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A73F0036');
        $this->addSql('ALTER TABLE disponibilites DROP FOREIGN KEY FK_B0F3489C9E45C554');
        $this->addSql('ALTER TABLE jour DROP FOREIGN KEY FK_DA17D9C59E45C554');
        $this->addSql('ALTER TABLE jour DROP FOREIGN KEY FK_DA17D9C52B9D6493');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADBCF5E72D');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADA73F0036');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559E45C554');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FB88E14F');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE disponibilites');
        $this->addSql('DROP TABLE jour');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE ville');
    }
}
