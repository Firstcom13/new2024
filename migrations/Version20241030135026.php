<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241030135026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_blog CHANGE contenu2 contenu2 LONGTEXT NOT NULL, CHANGE meta_description meta_description LONGTEXT NOT NULL, CHANGE publication publication INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE articles_blog_categorie ADD CONSTRAINT FK_63A2FBDF9F851A36 FOREIGN KEY (articles_blog_id) REFERENCES articles_blog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_blog_categorie ADD CONSTRAINT FK_63A2FBDFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie CHANGE date_creation date_creation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_497DD634989D9B62 ON categorie (slug)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_blog CHANGE contenu2 contenu2 LONGTEXT DEFAULT NULL, CHANGE meta_description meta_description LONGTEXT DEFAULT NULL, CHANGE publication publication TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE articles_blog_categorie DROP FOREIGN KEY FK_63A2FBDF9F851A36');
        $this->addSql('ALTER TABLE articles_blog_categorie DROP FOREIGN KEY FK_63A2FBDFBCF5E72D');
        $this->addSql('DROP INDEX UNIQ_497DD634989D9B62 ON categorie');
        $this->addSql('ALTER TABLE categorie CHANGE date_creation date_creation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
