<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151110125611 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE unidad_oferta DROP has_examen");
        $this->addSql("ALTER TABLE cargo ADD dependencia_referenciante_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE cargo ADD CONSTRAINT FK_3BEE577189AE3DE4 FOREIGN KEY (dependencia_referenciante_id) REFERENCES dependencia (id)");
        $this->addSql("CREATE INDEX IDX_3BEE577189AE3DE4 ON cargo (dependencia_referenciante_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE cargo DROP FOREIGN KEY FK_3BEE577189AE3DE4");
        $this->addSql("DROP INDEX IDX_3BEE577189AE3DE4 ON cargo");
        $this->addSql("ALTER TABLE cargo DROP dependencia_referenciante_id");
//        $this->addSql("ALTER TABLE unidad_oferta ADD has_examen TINYINT(1) DEFAULT NULL");
    }
}
