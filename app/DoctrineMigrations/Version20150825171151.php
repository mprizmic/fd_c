<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150825171151 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE unidad_oferta DROP FOREIGN KEY FK_95C6F11D83FF791E");
        $this->addSql("DROP INDEX UNIQ_95C6F11D83FF791E ON unidad_oferta");
        $this->addSql("ALTER TABLE unidad_oferta CHANGE salas_inicial_id inicial_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE unidad_oferta ADD CONSTRAINT FK_95C6F11D4C7AA4E4 FOREIGN KEY (inicial_id) REFERENCES inicial_x (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_95C6F11D4C7AA4E4 ON unidad_oferta (inicial_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE unidad_oferta DROP FOREIGN KEY FK_95C6F11D4C7AA4E4");
        $this->addSql("DROP INDEX UNIQ_95C6F11D4C7AA4E4 ON unidad_oferta");
        $this->addSql("ALTER TABLE unidad_oferta CHANGE inicial_id salas_inicial_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE unidad_oferta ADD CONSTRAINT FK_95C6F11D83FF791E FOREIGN KEY (salas_inicial_id) REFERENCES inicial_x (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_95C6F11D83FF791E ON unidad_oferta (salas_inicial_id)");
    }
}
