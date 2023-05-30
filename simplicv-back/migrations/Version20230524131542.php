<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230524131542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103CFE419E2');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFCFE419E2');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B5CFE419E2');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477CFE419E2');
        $this->addSql('ALTER TABLE social_medias DROP FOREIGN KEY FK_C99CD5DCFE419E2');
        $this->addSql('CREATE TABLE cover_letter (id INT AUTO_INCREMENT NOT NULL, firstname_sender VARCHAR(255) NOT NULL, lastname_sender VARCHAR(255) NOT NULL, mail_address_sender VARCHAR(255) NOT NULL, phone_number_sender INT NOT NULL, postal_address_receiver VARCHAR(255) NOT NULL, zip_code_receiver INT NOT NULL, city_receiver VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, date_of_creation DATE NOT NULL, place_of_creation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cover_letter_model (id INT AUTO_INCREMENT NOT NULL, cover_letter_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, text_font VARCHAR(255) NOT NULL, title_font VARCHAR(255) NOT NULL, bg_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, title_color VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_5621F66EB944729C (cover_letter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cover_letter_model ADD CONSTRAINT FK_5621F66EB944729C FOREIGN KEY (cover_letter_id) REFERENCES cover_letter_model (id)');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92275ED078');
        $this->addSql('ALTER TABLE cvmodel_cv DROP FOREIGN KEY FK_4FE29C1646B405D4');
        $this->addSql('ALTER TABLE cvmodel_cv DROP FOREIGN KEY FK_4FE29C16CFE419E2');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE cvmodel_cv');
        $this->addSql('ALTER TABLE cvmodel ADD title_font VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at VARCHAR(255) NOT NULL, CHANGE font text_font VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_590C103CFE419E2 ON experience');
        $this->addSql('ALTER TABLE experience CHANGE cv_id cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10346B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_590C10346B405D4 ON experience (cvmodel_id)');
        $this->addSql('DROP INDEX IDX_404021BFCFE419E2 ON formation');
        $this->addSql('ALTER TABLE formation CHANGE cv_id cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_404021BF46B405D4 ON formation (cvmodel_id)');
        $this->addSql('DROP INDEX IDX_D4DB71B5CFE419E2 ON language');
        $this->addSql('ALTER TABLE language CHANGE cv_id cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B546B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_D4DB71B546B405D4 ON language (cvmodel_id)');
        $this->addSql('ALTER TABLE profil ADD cvmodel_id INT DEFAULT NULL, ADD mail_address VARCHAR(255) NOT NULL, ADD title VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29746B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_E6D6B29746B405D4 ON profil (cvmodel_id)');
        $this->addSql('DROP INDEX IDX_5E3DE477CFE419E2 ON skill');
        $this->addSql('ALTER TABLE skill CHANGE cv_id cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47746B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE47746B405D4 ON skill (cvmodel_id)');
        $this->addSql('DROP INDEX IDX_C99CD5DCFE419E2 ON social_medias');
        $this->addSql('ALTER TABLE social_medias CHANGE cv_id cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_medias ADD CONSTRAINT FK_C99CD5D46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_C99CD5D46B405D4 ON social_medias (cvmodel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, profil_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_B66FFE92275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cvmodel_cv (cvmodel_id INT NOT NULL, cv_id INT NOT NULL, INDEX IDX_4FE29C1646B405D4 (cvmodel_id), INDEX IDX_4FE29C16CFE419E2 (cv_id), PRIMARY KEY(cvmodel_id, cv_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE cvmodel_cv ADD CONSTRAINT FK_4FE29C1646B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_cv ADD CONSTRAINT FK_4FE29C16CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cover_letter_model DROP FOREIGN KEY FK_5621F66EB944729C');
        $this->addSql('DROP TABLE cover_letter');
        $this->addSql('DROP TABLE cover_letter_model');
        $this->addSql('ALTER TABLE cvmodel ADD font VARCHAR(255) NOT NULL, DROP text_font, DROP title_font, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10346B405D4');
        $this->addSql('DROP INDEX IDX_590C10346B405D4 ON experience');
        $this->addSql('ALTER TABLE experience CHANGE cvmodel_id cv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_590C103CFE419E2 ON experience (cv_id)');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF46B405D4');
        $this->addSql('DROP INDEX IDX_404021BF46B405D4 ON formation');
        $this->addSql('ALTER TABLE formation CHANGE cvmodel_id cv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_404021BFCFE419E2 ON formation (cv_id)');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B546B405D4');
        $this->addSql('DROP INDEX IDX_D4DB71B546B405D4 ON language');
        $this->addSql('ALTER TABLE language CHANGE cvmodel_id cv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B5CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_D4DB71B5CFE419E2 ON language (cv_id)');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29746B405D4');
        $this->addSql('DROP INDEX IDX_E6D6B29746B405D4 ON profil');
        $this->addSql('ALTER TABLE profil DROP cvmodel_id, DROP mail_address, DROP title, DROP description');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47746B405D4');
        $this->addSql('DROP INDEX IDX_5E3DE47746B405D4 ON skill');
        $this->addSql('ALTER TABLE skill CHANGE cvmodel_id cv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477CFE419E2 ON skill (cv_id)');
        $this->addSql('ALTER TABLE social_medias DROP FOREIGN KEY FK_C99CD5D46B405D4');
        $this->addSql('DROP INDEX IDX_C99CD5D46B405D4 ON social_medias');
        $this->addSql('ALTER TABLE social_medias CHANGE cvmodel_id cv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_medias ADD CONSTRAINT FK_C99CD5DCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_C99CD5DCFE419E2 ON social_medias (cv_id)');
    }
}
