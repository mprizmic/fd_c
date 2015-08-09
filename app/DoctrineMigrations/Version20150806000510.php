<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150806000510 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE unidad_oferta ADD secundario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_oferta ADD CONSTRAINT FK_95C6F11DA4A10292 FOREIGN KEY (secundario_id) REFERENCES secundario_x (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_95C6F11DA4A10292 ON unidad_oferta (secundario_id)');
        $this->addSql('ALTER TABLE secundario_x DROP FOREIGN KEY FK_151CAFD6D1F42FF');
        $this->addSql('DROP INDEX UNIQ_151CAFD6D1F42FF ON secundario_x');
        $this->addSql('ALTER TABLE secundario_x DROP unidad_oferta_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE secundario_x ADD unidad_oferta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secundario_x ADD CONSTRAINT FK_151CAFD6D1F42FF FOREIGN KEY (unidad_oferta_id) REFERENCES unidad_oferta (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_151CAFD6D1F42FF ON secundario_x (unidad_oferta_id)');
        $this->addSql('ALTER TABLE unidad_oferta DROP FOREIGN KEY FK_95C6F11DA4A10292');
        $this->addSql('DROP INDEX UNIQ_95C6F11DA4A10292 ON unidad_oferta');
        $this->addSql('ALTER TABLE unidad_oferta DROP secundario_id');
    }
}
