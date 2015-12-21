<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151106113641 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE plantel_establecimiento (id INT AUTO_INCREMENT NOT NULL, organizacion_id INT DEFAULT NULL, cargo_id INT DEFAULT NULL, te VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_686FA49290B1019E (organizacion_id), INDEX IDX_686FA492813AC380 (cargo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE plantel_establecimiento ADD CONSTRAINT FK_686FA49290B1019E FOREIGN KEY (organizacion_id) REFERENCES organizacion_interna (id)");
        $this->addSql("ALTER TABLE plantel_establecimiento ADD CONSTRAINT FK_686FA492813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id)");
//        $this->addSql("ALTER TABLE unidad_oferta DROP has_examen");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE plantel_establecimiento");
//        $this->addSql("ALTER TABLE unidad_oferta ADD has_examen TINYINT(1) DEFAULT NULL");
    }
}
