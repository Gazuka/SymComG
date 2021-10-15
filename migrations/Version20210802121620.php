<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802121620 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comission (id INT AUTO_INCREMENT NOT NULL, chef_id INT DEFAULT NULL, titre_long VARCHAR(255) NOT NULL, titre_court VARCHAR(255) NOT NULL, INDEX IDX_8727369A150A48F1 (chef_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comission_profil (comission_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_8511E540BAD3DC8F (comission_id), INDEX IDX_8511E540275ED078 (profil_id), PRIMARY KEY(comission_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comission ADD CONSTRAINT FK_8727369A150A48F1 FOREIGN KEY (chef_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE comission_profil ADD CONSTRAINT FK_8511E540BAD3DC8F FOREIGN KEY (comission_id) REFERENCES comission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comission_profil ADD CONSTRAINT FK_8511E540275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comission_profil DROP FOREIGN KEY FK_8511E540BAD3DC8F');
        $this->addSql('DROP TABLE comission');
        $this->addSql('DROP TABLE comission_profil');
    }
}
