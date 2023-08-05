<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230625124235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, profil_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B66FFE92275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE experience ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE language ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE profil ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE skill ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE social_medias ADD position INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92275ED078');
        $this->addSql('DROP TABLE cv');
        $this->addSql('ALTER TABLE experience DROP position');
        $this->addSql('ALTER TABLE formation DROP position');
        $this->addSql('ALTER TABLE language DROP position');
        $this->addSql('ALTER TABLE profil DROP position');
        $this->addSql('ALTER TABLE skill DROP position');
        $this->addSql('ALTER TABLE social_medias DROP position');
    }
}
