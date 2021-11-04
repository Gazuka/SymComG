<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028143739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement_organisme (evenement_id INT NOT NULL, organisme_id INT NOT NULL, INDEX IDX_735149E2FD02F13 (evenement_id), INDEX IDX_735149E25DDD38F5 (organisme_id), PRIMARY KEY(evenement_id, organisme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_organisme ADD CONSTRAINT FK_735149E2FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_organisme ADD CONSTRAINT FK_735149E25DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evenement_organisme');
    }
}
