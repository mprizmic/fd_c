<?php

/**
 * esto es para sacar de la portada del backend las tablas que van a ir al menú superior agrupados como Datos personales de autoridades
 */
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151015160000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("delete from portada where etiqueta='Cargos'");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("insert into portada set "
                . " url='backend_cargo',"
                . " etiqueta='Cargos',"
                . " tabla='Cargo',"
                . " descripcion='Son los cargos de las autoridades según el estatuto'"
                . "");
    }
}
