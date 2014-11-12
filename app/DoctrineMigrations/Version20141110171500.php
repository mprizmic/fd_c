<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141110171500 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE unidad_oferta ADD localizacion_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE unidad_oferta ADD CONSTRAINT FK_95C6F11DC851F487 FOREIGN KEY (localizacion_id) REFERENCES localizacion (id)");
        $this->addSql("CREATE INDEX IDX_95C6F11DC851F487 ON unidad_oferta (localizacion_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE unidad_oferta DROP FOREIGN KEY FK_95C6F11DC851F487");
        $this->addSql("DROP INDEX IDX_95C6F11DC851F487 ON unidad_oferta");
        $this->addSql("ALTER TABLE unidad_oferta DROP localizacion_id");
    }
}
