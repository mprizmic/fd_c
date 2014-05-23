<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140522164856 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("DROP TABLE lexik_maintenance");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD origen_hora_id INT DEFAULT NULL, DROP origen_horas");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD CONSTRAINT FK_D4968F62EA54AA7B FOREIGN KEY (origen_hora_id) REFERENCES origen_hora (id)");
        $this->addSql("CREATE INDEX IDX_D4968F62EA54AA7B ON establecimiento_recurso (origen_hora_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE establecimiento_recurso DROP FOREIGN KEY FK_D4968F62EA54AA7B");
        $this->addSql("DROP INDEX IDX_D4968F62EA54AA7B ON establecimiento_recurso");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD origen_horas VARCHAR(255) DEFAULT NULL, DROP origen_hora_id");
    }
}
