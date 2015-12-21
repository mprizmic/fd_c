<?php
/**
 * corrio ok
 */
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151014180000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("update portada set url='backend_cargo' where etiqueta='Cargos'");
        $this->addSql("update portada set tabla='Cargo' where etiqueta='Cargos'");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("update portada set url='backend_cargo_autoridad' where etiqueta='Cargos'");
        $this->addSql("update portada set tabla='CargoAutoridad' where etiqueta='Cargos'");
    }
}
