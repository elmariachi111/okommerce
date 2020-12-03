<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203201539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product (uid UUID NOT NULL, title VARCHAR(255) NOT NULL, sku VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(uid))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product');
    }
}
