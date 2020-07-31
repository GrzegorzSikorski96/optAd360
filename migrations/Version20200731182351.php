<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200731182351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, name VARCHAR(100) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_694309E4979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, date DATE NOT NULL, revenue NUMERIC(8, 2) NOT NULL, impression INT NOT NULL, ecpm NUMERIC(8, 2) NOT NULL, clicks INT NOT NULL, ctr NUMERIC(5, 2) NOT NULL, INDEX IDX_E2D38B22F6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_site (tag_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_874CB652BAD26311 (tag_id), INDEX IDX_874CB652F6BD1646 (site_id), PRIMARY KEY(tag_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE tag_site ADD CONSTRAINT FK_874CB652BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_site ADD CONSTRAINT FK_874CB652F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4979B1AD6');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B22F6BD1646');
        $this->addSql('ALTER TABLE tag_site DROP FOREIGN KEY FK_874CB652F6BD1646');
        $this->addSql('ALTER TABLE tag_site DROP FOREIGN KEY FK_874CB652BAD26311');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_site');
    }
}
