<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131205150218 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("DROP TABLE lexik_maintenance");
        $this->addSql("ALTER TABLE establecimiento ADD cgp_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE establecimiento ADD CONSTRAINT FK_94A4D17EE68FCBB4 FOREIGN KEY (cgp_id) REFERENCES cgp (id)");
        $this->addSql("CREATE INDEX IDX_94A4D17EE68FCBB4 ON establecimiento (cgp_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE establecimiento DROP FOREIGN KEY FK_94A4D17EE68FCBB4");
        $this->addSql("DROP INDEX IDX_94A4D17EE68FCBB4 ON establecimiento");
        $this->addSql("ALTER TABLE establecimiento DROP cgp_id");
    }
}
