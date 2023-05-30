<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526125911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cover_letter (id INT AUTO_INCREMENT NOT NULL, firstname_sender VARCHAR(255) NOT NULL, lastname_sender VARCHAR(255) NOT NULL, mail_address_sender VARCHAR(255) NOT NULL, phone_number_sender INT NOT NULL, postal_address_receiver VARCHAR(255) NOT NULL, zip_code_receiver INT NOT NULL, city_receiver VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, date_of_creation DATE NOT NULL, place_of_creation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cover_letter_model (id INT AUTO_INCREMENT NOT NULL, cover_letter_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, text_font VARCHAR(255) NOT NULL, title_font VARCHAR(255) NOT NULL, bg_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, title_color VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_5621F66EB944729C (cover_letter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, bg_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, text_font VARCHAR(255) NOT NULL, title_font VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, cvmodel_id INT DEFAULT NULL, job_title VARCHAR(255) NOT NULL, employer VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, contrat_type LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', start_date DATE NOT NULL, end_date DATE NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_590C10346B405D4 (cvmodel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, cvmodel_id INT DEFAULT NULL, degree VARCHAR(255) NOT NULL, name_school VARCHAR(255) NOT NULL, location_school VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_404021BF46B405D4 (cvmodel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, cvmodel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D4DB71B546B405D4 (cvmodel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, cvmodel_id INT DEFAULT NULL, date_of_birth DATE NOT NULL, phone_number INT NOT NULL, postal_address VARCHAR(255) NOT NULL, zip_code INT NOT NULL, city VARCHAR(255) NOT NULL, driving_licence VARCHAR(255) DEFAULT NULL, mail_address VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_E6D6B29746B405D4 (cvmodel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, cvmodel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5E3DE47746B405D4 (cvmodel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_medias (id INT AUTO_INCREMENT NOT NULL, cvmodel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_C99CD5D46B405D4 (cvmodel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cover_letter_model ADD CONSTRAINT FK_5621F66EB944729C FOREIGN KEY (cover_letter_id) REFERENCES cover_letter_model (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10346B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B546B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29746B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47746B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('ALTER TABLE social_medias ADD CONSTRAINT FK_C99CD5D46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cover_letter_model DROP FOREIGN KEY FK_5621F66EB944729C');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10346B405D4');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF46B405D4');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B546B405D4');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29746B405D4');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47746B405D4');
        $this->addSql('ALTER TABLE social_medias DROP FOREIGN KEY FK_C99CD5D46B405D4');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE cover_letter');
        $this->addSql('DROP TABLE cover_letter_model');
        $this->addSql('DROP TABLE cvmodel');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE social_medias');
        $this->addSql('DROP TABLE user');
    }
}
