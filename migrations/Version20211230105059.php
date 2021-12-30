<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211230105059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement_type_public (evenement_id INT NOT NULL, type_public_id INT NOT NULL, INDEX IDX_89F6530EFD02F13 (evenement_id), INDEX IDX_89F6530E172CA81 (type_public_id), PRIMARY KEY(evenement_id, type_public_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_type_public ADD CONSTRAINT FK_89F6530EFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_type_public ADD CONSTRAINT FK_89F6530E172CA81 FOREIGN KEY (type_public_id) REFERENCES type_public (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evenement_type_public');
    }
}
