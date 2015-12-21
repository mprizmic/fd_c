<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151110154727 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE unidad_oferta DROP has_examen");
        $this->addSql("ALTER TABLE autoridad DROP INDEX IDX_14FFC077813AC380, ADD UNIQUE INDEX UNIQ_14FFC077813AC380 (cargo_id)");
        $this->addSql("ALTER TABLE autoridad DROP FOREIGN KEY FK_14FFC077813AC380");
        $this->addSql("ALTER TABLE autoridad ADD CONSTRAINT FK_14FFC077813AC380 FOREIGN KEY (cargo_id) REFERENCES plantel_establecimiento (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE autoridad DROP INDEX UNIQ_14FFC077813AC380, ADD INDEX IDX_14FFC077813AC380 (cargo_id)");
        $this->addSql("ALTER TABLE autoridad DROP FOREIGN KEY FK_14FFC077813AC380");
        $this->addSql("ALTER TABLE autoridad ADD CONSTRAINT FK_14FFC077813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id)");
//        $this->addSql("ALTER TABLE unidad_oferta ADD has_examen TINYINT(1) DEFAULT NULL");
    }
}
