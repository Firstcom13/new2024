<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213161919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_blog CHANGE date_creation date_creation DATETIME DEFAULT NULL, CHANGE date_update date_update DATETIME DEFAULT NULL, CHANGE date_delete date_delete DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD date_creation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_blog CHANGE date_creation date_creation DATE DEFAULT NULL, CHANGE date_update date_update DATE DEFAULT NULL, CHANGE date_delete date_delete DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE contact DROP date_creation');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
