<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150519150003 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE titulo DROP FOREIGN KEY FK_17713E5A2C22C346");
        $this->addSql("DROP INDEX IDX_17713E5A2C22C346 ON titulo");
        $this->addSql("ALTER TABLE titulo DROP estado_validez_id, DROP fecha_estado_validez, DROP validez_desde, DROP validez_hasta");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE titulo ADD estado_validez_id INT DEFAULT NULL, ADD fecha_estado_validez DATE DEFAULT NULL, ADD validez_desde DATE DEFAULT NULL, ADD validez_hasta DATE DEFAULT NULL");
        $this->addSql("ALTER TABLE titulo ADD CONSTRAINT FK_17713E5A2C22C346 FOREIGN KEY (estado_validez_id) REFERENCES estado_validez (id)");
        $this->addSql("CREATE INDEX IDX_17713E5A2C22C346 ON titulo (estado_validez_id)");
    }
}
