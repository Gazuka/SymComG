<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211030131743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement_classeur (evenement_id INT NOT NULL, classeur_id INT NOT NULL, INDEX IDX_5E3918B2FD02F13 (evenement_id), INDEX IDX_5E3918B2EC10E96A (classeur_id), PRIMARY KEY(evenement_id, classeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_classeur ADD CONSTRAINT FK_5E3918B2FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_classeur ADD CONSTRAINT FK_5E3918B2EC10E96A FOREIGN KEY (classeur_id) REFERENCES classeur__classeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evenement_classeur');
    }
}
