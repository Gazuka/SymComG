<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210514142829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composant_valeur DROP FOREIGN KEY FK_ABD4EF9D7F3310E7');
        $this->addSql('ALTER TABLE composant_caracteristique DROP FOREIGN KEY FK_C1ED4EB54296D31F');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C9AC14B70A');
        $this->addSql('ALTER TABLE composant_caracteristique DROP FOREIGN KEY FK_C1ED4EB5AC14B70A');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426282C2B3856');
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003FC4663E4');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE composant');
        $this->addSql('DROP TABLE composant_caracteristique');
        $this->addSql('DROP TABLE composant_genre');
        $this->addSql('DROP TABLE composant_modele');
        $this->addSql('DROP TABLE composant_valeur');
        $this->addSql('DROP TABLE contenu');
        $this->addSql('DROP TABLE element_paragraphe');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE page');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE composant (id INT AUTO_INCREMENT NOT NULL, modele_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_EC8486C9AC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE composant_caracteristique (id INT AUTO_INCREMENT NOT NULL, genre_id INT NOT NULL, modele_id INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, obligatoire TINYINT(1) NOT NULL, INDEX IDX_C1ED4EB54296D31F (genre_id), INDEX IDX_C1ED4EB5AC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE composant_genre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE composant_modele (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, twig VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE composant_valeur (id INT AUTO_INCREMENT NOT NULL, composant_id INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, var_string VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, var_text LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, var_boolean TINYINT(1) DEFAULT NULL, var_integer INT DEFAULT NULL, var_float DOUBLE PRECISION DEFAULT NULL, var_array LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', var_object LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', var_datetime DATETIME DEFAULT NULL, var_date DATE DEFAULT NULL, var_time TIME DEFAULT NULL, var_dateinterval VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:dateinterval)\', INDEX IDX_ABD4EF9D7F3310E7 (composant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contenu (id INT AUTO_INCREMENT NOT NULL, page_id INT NOT NULL, position INT DEFAULT NULL, INDEX IDX_89C2003FC4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE element_paragraphe (id INT AUTO_INCREMENT NOT NULL, texte LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, element_paragraphe_id INT DEFAULT NULL, INDEX IDX_C2426282C2B3856 (element_paragraphe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C9AC14B70A FOREIGN KEY (modele_id) REFERENCES composant_modele (id)');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB54296D31F FOREIGN KEY (genre_id) REFERENCES composant_genre (id)');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB5AC14B70A FOREIGN KEY (modele_id) REFERENCES composant_modele (id)');
        $this->addSql('ALTER TABLE composant_valeur ADD CONSTRAINT FK_ABD4EF9D7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003FC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426282C2B3856 FOREIGN KEY (element_paragraphe_id) REFERENCES element_paragraphe (id)');
        $this->addSql('DROP TABLE menu');
    }
}
