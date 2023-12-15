<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213093251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_blog (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description_courte LONGTEXT DEFAULT NULL, contenu LONGTEXT NOT NULL, img_s VARCHAR(255) DEFAULT NULL, img_xl VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, date_update DATE DEFAULT NULL, date_delete DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_blog_categorie (articles_blog_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_63A2FBDF9F851A36 (articles_blog_id), INDEX IDX_63A2FBDFBCF5E72D (categorie_id), PRIMARY KEY(articles_blog_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_blog_categorie ADD CONSTRAINT FK_63A2FBDF9F851A36 FOREIGN KEY (articles_blog_id) REFERENCES articles_blog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_blog_categorie ADD CONSTRAINT FK_63A2FBDFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD date_creation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_blog_categorie DROP FOREIGN KEY FK_63A2FBDF9F851A36');
        $this->addSql('ALTER TABLE articles_blog_categorie DROP FOREIGN KEY FK_63A2FBDFBCF5E72D');
        $this->addSql('DROP TABLE articles_blog');
        $this->addSql('DROP TABLE articles_blog_categorie');
        $this->addSql('ALTER TABLE contact DROP date_creation');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
