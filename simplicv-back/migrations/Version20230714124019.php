<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230714124019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cvmodel ADD title_color VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profil CHANGE date_of_birth date_of_birth DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cvmodel DROP title_color');
        $this->addSql('ALTER TABLE profil CHANGE date_of_birth date_of_birth DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }
}
