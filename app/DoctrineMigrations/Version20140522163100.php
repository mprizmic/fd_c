<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140522163100 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE origen_hora (id INT AUTO_INCREMENT NOT NULL, codigo INT NOT NULL, descripcion VARCHAR(20) NOT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
//        $this->addSql("DROP TABLE lexik_maintenance");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD origen_horas VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE origen_hora");
        $this->addSql("ALTER TABLE establecimiento_recurso DROP origen_horas");
    }
}
