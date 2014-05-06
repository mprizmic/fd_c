<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140411123658 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("DROP TABLE lexik_maintenance");
        $this->addSql("ALTER TABLE resumen_media ADD horario_lunes VARCHAR(100) DEFAULT NULL, ADD horario_martes VARCHAR(100) DEFAULT NULL, ADD horario_miercoles VARCHAR(100) DEFAULT NULL, ADD horario_jueves VARCHAR(100) DEFAULT NULL, ADD horario_viernes VARCHAR(100) DEFAULT NULL, CHANGE cantidad_horas cantidad_horas VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE resumen_media DROP horario_lunes, DROP horario_martes, DROP horario_miercoles, DROP horario_jueves, DROP horario_viernes, CHANGE cantidad_horas cantidad_horas DOUBLE PRECISION DEFAULT NULL");
    }
}
