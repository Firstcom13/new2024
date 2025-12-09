<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251209131948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->dropIndexIfExists('ext_translations', 'lookup_unique_idx');
        $this->dropIndexIfExists('ext_translations', 'general_translations_lookup_idx');
        $this->dropIndexIfExists('ext_translations', 'translations_lookup_idx');
    }

    public function down(Schema $schema): void
    {
        $this->createIndexIfMissing('ext_translations', 'lookup_unique_idx', 'CREATE UNIQUE INDEX lookup_unique_idx ON ext_translations (locale, object_class, field, foreign_key)');
        $this->createIndexIfMissing('ext_translations', 'general_translations_lookup_idx', 'CREATE INDEX general_translations_lookup_idx ON ext_translations (object_class, foreign_key)');
        $this->createIndexIfMissing('ext_translations', 'translations_lookup_idx', 'CREATE INDEX translations_lookup_idx ON ext_translations (locale, object_class, foreign_key)');
    }

    private function dropIndexIfExists(string $table, string $index): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        if (!$schemaManager->tablesExist([$table])) {
            return;
        }

        $indexes = $schemaManager->listTableIndexes($table);
        if (array_key_exists($index, $indexes)) {
            $this->addSql(sprintf('DROP INDEX %s ON %s', $index, $table));
        }
    }

    private function createIndexIfMissing(string $table, string $index, string $sql): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        if (!$schemaManager->tablesExist([$table])) {
            return;
        }

        $indexes = $schemaManager->listTableIndexes($table);
        if (!array_key_exists($index, $indexes)) {
            $this->addSql($sql);
        }
    }
}
