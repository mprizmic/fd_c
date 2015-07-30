<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150730125258 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $sql = "update portada ";
        $sql .= "set url='en_desarrollo2' ";
        $sql .= "where tabla='GrupoEtario' ";
        $sql .= "or tabla='Pais' ";
        $sql .= "or tabla='OrigenHora' ";
        $sql .= "or tabla='Orientacion' ";
        $sql .= "or tabla='Sector' ";
        $sql .= "or tabla='Turno' ";
        $sql .= "or tabla='TipoEstablecimiento' ";
                
        $this->addSql($sql);

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
