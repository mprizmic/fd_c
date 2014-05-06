<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130903145540 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE seguimiento_cohorte");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE seguimiento_cohorte (id INT AUTO_INCREMENT NOT NULL, cohorte_id INT DEFAULT NULL, año INT DEFAULT NULL, INDEX IDX_98CCF6ABFB30EFA4 (cohorte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE seguimiento_cohorte ADD CONSTRAINT FK_98CCF6ABFB30EFA4 FOREIGN KEY (cohorte_id) REFERENCES unidad_oferta (id)");
    }
}
