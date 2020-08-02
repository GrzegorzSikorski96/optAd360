<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200802125851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistics ADD estimated_revenue NUMERIC(8, 2) NOT NULL, ADD ad_ecpm NUMERIC(8, 2) NOT NULL, DROP revenue, DROP ecpm, CHANGE impression ad_impressions INT NOT NULL, CHANGE ctr ad_ctr NUMERIC(5, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistics ADD revenue NUMERIC(8, 2) NOT NULL, ADD ecpm NUMERIC(8, 2) NOT NULL, DROP estimated_revenue, DROP ad_ecpm, CHANGE ad_impression impressions INT NOT NULL, CHANGE ad_ctr ctr NUMERIC(5, 2) NOT NULL');
    }
}
