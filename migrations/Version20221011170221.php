<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011170221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disponibilites CHANGE datetime_debut datetime_debut DATETIME DEFAULT NULL, CHANGE datetime_fin datetime_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation CHANGE statut statut TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX ville_nom ON ville');
        $this->addSql('DROP INDEX ville_code_postal ON ville');
        $this->addSql('DROP INDEX ville_code_commune_2 ON ville');
        $this->addSql('DROP INDEX ville_code_commune ON ville');
        $this->addSql('ALTER TABLE ville ADD ville VARCHAR(255) NOT NULL, ADD code_postal INT NOT NULL, DROP ville_nom, DROP ville_code_postal, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE ville_code_commune code_commune VARCHAR(5) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville ADD ville_nom VARCHAR(45) DEFAULT NULL, ADD ville_code_postal VARCHAR(255) DEFAULT NULL, DROP ville, DROP code_postal, CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE code_commune ville_code_commune VARCHAR(5) NOT NULL');
        $this->addSql('CREATE INDEX ville_nom ON ville (ville_nom)');
        $this->addSql('CREATE INDEX ville_code_postal ON ville (ville_code_postal)');
        $this->addSql('CREATE UNIQUE INDEX ville_code_commune_2 ON ville (ville_code_commune)');
        $this->addSql('CREATE INDEX ville_code_commune ON ville (ville_code_commune)');
        $this->addSql('ALTER TABLE disponibilites CHANGE datetime_debut datetime_debut DATETIME NOT NULL, CHANGE datetime_fin datetime_fin DATETIME NOT NULL');
        $this->addSql('ALTER TABLE prestation CHANGE statut statut INT NOT NULL');
    }
}
