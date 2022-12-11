<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221211124713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Organization: add order';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organization ADD `order` INT');
        $this->addSql('UPDATE organization set `order`=`id`');
        $this->addSql('ALTER TABLE organization modify `order` int not null');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organization DROP `order`');
    }
}
