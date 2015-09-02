<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150902151822 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE establecimiento DROP FOREIGN KEY FK_94A4D17E418D0677");
        $this->addSql("DROP INDEX IDX_94A4D17E418D0677 ON establecimiento");
        $this->addSql("ALTER TABLE establecimiento DROP cargo_autoridad_id, DROP nombre_autoridad");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE establecimiento ADD cargo_autoridad_id INT DEFAULT NULL, ADD nombre_autoridad VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE establecimiento ADD CONSTRAINT FK_94A4D17E418D0677 FOREIGN KEY (cargo_autoridad_id) REFERENCES cargo_autoridad (id)");
        $this->addSql("CREATE INDEX IDX_94A4D17E418D0677 ON establecimiento (cargo_autoridad_id)");
    }
}
