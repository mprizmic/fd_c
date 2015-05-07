<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150304170502 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE unidad_oferta ADD salas_inicial_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE unidad_oferta ADD CONSTRAINT FK_95C6F11D83FF791E FOREIGN KEY (salas_inicial_id) REFERENCES inicial_x (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_95C6F11D83FF791E ON unidad_oferta (salas_inicial_id)");
        $this->addSql("ALTER TABLE inicial_x DROP FOREIGN KEY FK_766EEA91D1F42FF");
        $this->addSql("DROP INDEX UNIQ_766EEA91D1F42FF ON inicial_x");
        $this->addSql("ALTER TABLE inicial_x DROP unidad_oferta_id");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE inicial_x ADD unidad_oferta_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE inicial_x ADD CONSTRAINT FK_766EEA91D1F42FF FOREIGN KEY (unidad_oferta_id) REFERENCES unidad_oferta (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_766EEA91D1F42FF ON inicial_x (unidad_oferta_id)");
        $this->addSql("ALTER TABLE unidad_oferta DROP FOREIGN KEY FK_95C6F11D83FF791E");
        $this->addSql("DROP INDEX UNIQ_95C6F11D83FF791E ON unidad_oferta");
        $this->addSql("ALTER TABLE unidad_oferta DROP salas_inicial_id");
    }
}
