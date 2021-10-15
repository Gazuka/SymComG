<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430141301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE elem_x (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE elem_zone ADD elem_x_id INT NOT NULL');
        $this->addSql('ALTER TABLE elem_zone ADD CONSTRAINT FK_21B15D769795D63C FOREIGN KEY (elem_x_id) REFERENCES elem_x (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21B15D769795D63C ON elem_zone (elem_x_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_zone DROP FOREIGN KEY FK_21B15D769795D63C');
        $this->addSql('DROP TABLE elem_x');
        $this->addSql('DROP INDEX UNIQ_21B15D769795D63C ON elem_zone');
        $this->addSql('ALTER TABLE elem_zone DROP elem_x_id');
    }
}
