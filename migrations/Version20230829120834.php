<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230829120834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre ADD pseudo VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD civilite VARCHAR(255) NOT NULL, ADD statut INT NOT NULL, ADD date_enregistrement DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre DROP pseudo, DROP nom, DROP prenom, DROP civilite, DROP statut, DROP date_enregistrement');
    }
}
