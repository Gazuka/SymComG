<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106141719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chemin_route_param (chemin_id INT NOT NULL, route_param_id INT NOT NULL, INDEX IDX_C8F839A03BD6E429 (chemin_id), INDEX IDX_C8F839A0A86B8048 (route_param_id), PRIMARY KEY(chemin_id, route_param_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chemin_route_param ADD CONSTRAINT FK_C8F839A03BD6E429 FOREIGN KEY (chemin_id) REFERENCES chemin2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chemin_route_param ADD CONSTRAINT FK_C8F839A0A86B8048 FOREIGN KEY (route_param_id) REFERENCES route_param (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chemin2 ADD route_id INT NOT NULL');
        $this->addSql('ALTER TABLE chemin2 ADD CONSTRAINT FK_2FA434D434ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id)');
        $this->addSql('CREATE INDEX IDX_2FA434D434ECB4E6 ON chemin2 (route_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chemin_route_param');
        $this->addSql('ALTER TABLE chemin2 DROP FOREIGN KEY FK_2FA434D434ECB4E6');
        $this->addSql('DROP INDEX IDX_2FA434D434ECB4E6 ON chemin2');
        $this->addSql('ALTER TABLE chemin2 DROP route_id');
    }
}
