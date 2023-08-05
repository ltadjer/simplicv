<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627100728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrat_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience ADD contrat_type_id INT DEFAULT NULL, DROP contrat_type');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1036C82DFE5 FOREIGN KEY (contrat_type_id) REFERENCES contrat_type (id)');
        $this->addSql('CREATE INDEX IDX_590C1036C82DFE5 ON experience (contrat_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1036C82DFE5');
        $this->addSql('DROP TABLE contrat_type');
        $this->addSql('DROP INDEX IDX_590C1036C82DFE5 ON experience');
        $this->addSql('ALTER TABLE experience ADD contrat_type LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP contrat_type_id');
    }
}
