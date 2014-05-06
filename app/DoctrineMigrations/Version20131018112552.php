<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131018112552 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE p1 DROP FOREIGN KEY p1_ibfk_1");
        $this->addSql("DROP TABLE lexik_maintenance");
        $this->addSql("ALTER TABLE unidad_oferta ADD creado DATETIME NOT NULL, ADD actualizado DATETIME NOT NULL");
        $this->addSql("ALTER TABLE unidad_educativa ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
        $this->addSql("ALTER TABLE oferta_educativa ADD creado DATETIME NOT NULL, ADD actualizado DATETIME NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
//        $this->addSql("ALTER TABLE p1 ADD CONSTRAINT p1_ibfk_1 FOREIGN KEY (p2_id) REFERENCES p2 (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE oferta_educativa DROP creado, DROP actualizado");
        $this->addSql("ALTER TABLE unidad_educativa DROP actualizado, DROP creado");
        $this->addSql("ALTER TABLE unidad_oferta DROP creado, DROP actualizado");
    }
}
