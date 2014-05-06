<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140401163255 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE resumen_media (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(20) DEFAULT NULL, fecha VARCHAR(30) DEFAULT NULL, cargo VARCHAR(40) DEFAULT NULL, establecimiento VARCHAR(100) DEFAULT NULL, cargo_vacante VARCHAR(150) DEFAULT NULL, fecha_iniciacion DATE DEFAULT NULL, fecha_terminacion DATE DEFAULT NULL, cantidad_horas DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE ResumenMedia");
//        $this->addSql("DROP TABLE lexik_maintenance");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE ResumenMedia (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(20) DEFAULT NULL, fecha VARCHAR(30) DEFAULT NULL, cargo VARCHAR(40) DEFAULT NULL, establecimiento VARCHAR(100) DEFAULT NULL, cargo_vacante VARCHAR(150) DEFAULT NULL, fecha_iniciacion DATE DEFAULT NULL, fecha_terminacion DATE DEFAULT NULL, cantidad_horas DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE resumen_media");
    }
}
