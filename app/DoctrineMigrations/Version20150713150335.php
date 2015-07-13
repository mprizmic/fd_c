<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Crear el registro de la tabla media_orietaciones en la PORTADA de la portada del backend
 * 
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150713150335 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $sql = "insert into portada (tabla, descripcion, actualizado, creado, url) ";
        $sql .= " values ('Orientaciones de la NES', null , CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'backend.mediaorientaciones.buscar') ";
        
        $this->addSql($sql);

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
