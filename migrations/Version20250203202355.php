<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203202355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bottle_cellar (bottle_id INT NOT NULL, cellar_id INT NOT NULL, INDEX IDX_50E72E8CDCF9352B (bottle_id), INDEX IDX_50E72E8CD4A8C468 (cellar_id), PRIMARY KEY(bottle_id, cellar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bottle_grapes (bottle_id INT NOT NULL, grapes_id INT NOT NULL, INDEX IDX_ED8B5053DCF9352B (bottle_id), INDEX IDX_ED8B5053A7C5CFD3 (grapes_id), PRIMARY KEY(bottle_id, grapes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cellar (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9CA01463A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grapes (id INT AUTO_INCREMENT NOT NULL, grape VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, region VARCHAR(255) NOT NULL, INDEX IDX_F62F176F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE year (id INT AUTO_INCREMENT NOT NULL, year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bottle_cellar ADD CONSTRAINT FK_50E72E8CDCF9352B FOREIGN KEY (bottle_id) REFERENCES bottle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bottle_cellar ADD CONSTRAINT FK_50E72E8CD4A8C468 FOREIGN KEY (cellar_id) REFERENCES cellar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bottle_grapes ADD CONSTRAINT FK_ED8B5053DCF9352B FOREIGN KEY (bottle_id) REFERENCES bottle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bottle_grapes ADD CONSTRAINT FK_ED8B5053A7C5CFD3 FOREIGN KEY (grapes_id) REFERENCES grapes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cellar ADD CONSTRAINT FK_9CA01463A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE bottle ADD user_id INT NOT NULL, ADD year_id INT NOT NULL, ADD region_id INT NOT NULL, ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE bottle ADD CONSTRAINT FK_ACA9A955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bottle ADD CONSTRAINT FK_ACA9A95540C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE bottle ADD CONSTRAINT FK_ACA9A95598260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE bottle ADD CONSTRAINT FK_ACA9A955F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_ACA9A955A76ED395 ON bottle (user_id)');
        $this->addSql('CREATE INDEX IDX_ACA9A95540C1FEA7 ON bottle (year_id)');
        $this->addSql('CREATE INDEX IDX_ACA9A95598260155 ON bottle (region_id)');
        $this->addSql('CREATE INDEX IDX_ACA9A955F92F3E70 ON bottle (country_id)');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bottle DROP FOREIGN KEY FK_ACA9A955F92F3E70');
        $this->addSql('ALTER TABLE bottle DROP FOREIGN KEY FK_ACA9A95598260155');
        $this->addSql('ALTER TABLE bottle DROP FOREIGN KEY FK_ACA9A95540C1FEA7');
        $this->addSql('ALTER TABLE bottle_cellar DROP FOREIGN KEY FK_50E72E8CDCF9352B');
        $this->addSql('ALTER TABLE bottle_cellar DROP FOREIGN KEY FK_50E72E8CD4A8C468');
        $this->addSql('ALTER TABLE bottle_grapes DROP FOREIGN KEY FK_ED8B5053DCF9352B');
        $this->addSql('ALTER TABLE bottle_grapes DROP FOREIGN KEY FK_ED8B5053A7C5CFD3');
        $this->addSql('ALTER TABLE cellar DROP FOREIGN KEY FK_9CA01463A76ED395');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176F92F3E70');
        $this->addSql('DROP TABLE bottle_cellar');
        $this->addSql('DROP TABLE bottle_grapes');
        $this->addSql('DROP TABLE cellar');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE grapes');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE year');
        $this->addSql('ALTER TABLE bottle DROP FOREIGN KEY FK_ACA9A955A76ED395');
        $this->addSql('DROP INDEX IDX_ACA9A955A76ED395 ON bottle');
        $this->addSql('DROP INDEX IDX_ACA9A95540C1FEA7 ON bottle');
        $this->addSql('DROP INDEX IDX_ACA9A95598260155 ON bottle');
        $this->addSql('DROP INDEX IDX_ACA9A955F92F3E70 ON bottle');
        $this->addSql('ALTER TABLE bottle DROP user_id, DROP year_id, DROP region_id, DROP country_id');
        $this->addSql('ALTER TABLE user DROP username');
    }
}
