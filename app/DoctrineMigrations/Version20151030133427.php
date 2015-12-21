<?php
/**
 * corrió ok
 */
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151030133427 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE unidad_oferta DROP has_examen");
        $this->addSql("ALTER TABLE establecimiento_edificio DROP te1, DROP te2, DROP te3, DROP email1, DROP email2");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE establecimiento_edificio ADD te1 VARCHAR(255) DEFAULT NULL, ADD te2 VARCHAR(255) DEFAULT NULL, ADD te3 VARCHAR(255) DEFAULT NULL, ADD email1 VARCHAR(255) DEFAULT NULL, ADD email2 VARCHAR(255) DEFAULT NULL");
//        $this->addSql("ALTER TABLE unidad_oferta ADD has_examen TINYINT(1) DEFAULT NULL");
    }
}
