<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230823142023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs_page CHANGE bloc_h3 bloc_h3 VARCHAR(255) DEFAULT NULL, CHANGE bloc_image bloc_image VARCHAR(255) DEFAULT NULL, CHANGE bloc_lien_text bloc_lien_text VARCHAR(255) DEFAULT NULL, CHANGE bloc_lien_url bloc_lien_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE society society VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD background_image VARCHAR(255) NOT NULL, CHANGE entete_image entete_image VARCHAR(255) DEFAULT NULL, CHANGE entete_bis_h3 entete_bis_h3 VARCHAR(255) DEFAULT NULL, CHANGE entete_bis_image entete_bis_image VARCHAR(255) DEFAULT NULL, CHANGE titre titre VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE reference CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE url url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs_page CHANGE bloc_h3 bloc_h3 VARCHAR(255) DEFAULT \'NULL\', CHANGE bloc_image bloc_image VARCHAR(255) DEFAULT \'NULL\', CHANGE bloc_lien_text bloc_lien_text VARCHAR(255) DEFAULT \'NULL\', CHANGE bloc_lien_url bloc_lien_url VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE contact CHANGE society society VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE page DROP background_image, CHANGE titre titre VARCHAR(150) DEFAULT \'NULL\', CHANGE entete_image entete_image VARCHAR(255) DEFAULT \'NULL\', CHANGE entete_bis_h3 entete_bis_h3 VARCHAR(255) DEFAULT \'NULL\', CHANGE entete_bis_image entete_bis_image VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE reference CHANGE image image VARCHAR(255) DEFAULT \'NULL\', CHANGE url url VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
