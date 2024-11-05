<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105093004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reference CHANGE nom_reference nom_reference VARCHAR(20) NOT NULL');
        $this->addSql('DROP INDEX nom_reference ON reference');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AEA349133A523852 ON reference (nom_reference)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reference CHANGE nom_reference nom_reference VARCHAR(20) DEFAULT NULL');
        $this->addSql('DROP INDEX uniq_aea349133a523852 ON reference');
        $this->addSql('CREATE UNIQUE INDEX nom_reference ON reference (nom_reference)');
    }
}
