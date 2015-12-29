<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151229154528 extends AbstractMigration
{
    public function up(Schema $schema)
    {


        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE disciplina (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(3) DEFAULT NULL, descripcion VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE carrera ADD disciplina_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE carrera ADD CONSTRAINT FK_CF1ECD302A30B056 FOREIGN KEY (disciplina_id) REFERENCES disciplina (id)");
        $this->addSql("CREATE INDEX IDX_CF1ECD302A30B056 ON carrera (disciplina_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE carrera DROP FOREIGN KEY FK_CF1ECD302A30B056");
        $this->addSql("DROP TABLE disciplina");
        $this->addSql("DROP INDEX IDX_CF1ECD302A30B056 ON carrera");
        $this->addSql("ALTER TABLE carrera DROP disciplina_id");
    }
}
