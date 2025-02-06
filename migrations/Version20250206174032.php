<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206174032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country CHANGE country name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE grapes CHANGE grape name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE region CHANGE region name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country CHANGE name country VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE grapes CHANGE name grape VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE region CHANGE name region VARCHAR(255) NOT NULL');
    }
}
