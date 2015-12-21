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
class Version20151105143448 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE unidad_oferta DROP has_examen");
        $this->addSql("ALTER TABLE autoridad DROP FOREIGN KEY FK_14FFC07771B61351");
        $this->addSql("DROP INDEX IDX_14FFC07771B61351 ON autoridad");
        $this->addSql("ALTER TABLE autoridad DROP establecimiento_id");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE autoridad ADD establecimiento_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE autoridad ADD CONSTRAINT FK_14FFC07771B61351 FOREIGN KEY (establecimiento_id) REFERENCES establecimiento (id)");
        $this->addSql("CREATE INDEX IDX_14FFC07771B61351 ON autoridad (establecimiento_id)");
//        $this->addSql("ALTER TABLE unidad_oferta ADD has_examen TINYINT(1) DEFAULT NULL");
    }
}
