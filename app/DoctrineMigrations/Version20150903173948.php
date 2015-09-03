<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150903173948 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // aflorar en la portada del backend el CRUD de grupo etario
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("update portada set url='backend.grupo_etario' where tabla='GrupoEtario'");

    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("update portada set url='en_desarrollo' where tabla='GrupoEtario'");
    }
}
