<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140220182818 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE usuario ADD rol_id INT DEFAULT NULL, DROP rol");
//        $this->addSql("ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D4BAB96C FOREIGN KEY (rol_id) REFERENCES rol (id)");
//        $this->addSql("CREATE INDEX IDX_2265B05D4BAB96C ON usuario (rol_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D4BAB96C");
//        $this->addSql("DROP INDEX IDX_2265B05D4BAB96C ON usuario");
        $this->addSql("ALTER TABLE usuario ADD rol VARCHAR(25) NOT NULL, DROP rol_id");
    }
}
