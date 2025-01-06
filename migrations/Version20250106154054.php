<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250106154054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create event store table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE event_store (id UUID NOT NULL, aggregate_id UUID NOT NULL, event_name VARCHAR(255) NOT NULL, payload JSON NOT NULL, occurred_on TIMESTAMP WITH TIME ZONE NOT NULL, created_at TIMESTAMP WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX event_store_aggregate_id ON event_store (aggregate_id)');
        $this->addSql('CREATE INDEX event_store_event_name_id ON event_store (event_name)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE event_store');
    }
}
