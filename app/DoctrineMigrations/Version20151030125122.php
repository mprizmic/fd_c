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
class Version20151030125122 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE organizacion_interna (id INT AUTO_INCREMENT NOT NULL, dependencia_id INT DEFAULT NULL, establecimiento_id INT DEFAULT NULL, te VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_92FADEB5DF2432B6 (dependencia_id), INDEX IDX_92FADEB571B61351 (establecimiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE organizacion_interna ADD CONSTRAINT FK_92FADEB5DF2432B6 FOREIGN KEY (dependencia_id) REFERENCES dependencia (id)");
        $this->addSql("ALTER TABLE organizacion_interna ADD CONSTRAINT FK_92FADEB571B61351 FOREIGN KEY (establecimiento_id) REFERENCES establecimiento_edificio (id)");
        $this->addSql("DROP TABLE ee_dependencia");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE ee_dependencia (id INT AUTO_INCREMENT NOT NULL, establecimiento_id INT DEFAULT NULL, dependencia_id INT DEFAULT NULL, te VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_3D418597DF2432B6 (dependencia_id), INDEX IDX_3D41859771B61351 (establecimiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE ee_dependencia ADD CONSTRAINT FK_3D41859771B61351 FOREIGN KEY (establecimiento_id) REFERENCES establecimiento_edificio (id)");
        $this->addSql("ALTER TABLE ee_dependencia ADD CONSTRAINT FK_3D418597DF2432B6 FOREIGN KEY (dependencia_id) REFERENCES dependencia (id)");
        $this->addSql("DROP TABLE organizacion_interna");
    }
}
