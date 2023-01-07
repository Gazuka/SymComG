<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107130956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisme__association ADD actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE organisme__entreprise ADD actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE organisme__service ADD actif TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisme__association DROP actif');
        $this->addSql('ALTER TABLE organisme__entreprise DROP actif');
        $this->addSql('ALTER TABLE organisme__service DROP actif');
    }
}
