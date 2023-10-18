<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018061610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cristalizacion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mineral ADD cristalizacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE mineral ADD CONSTRAINT FK_1D9BA97F18602F65 FOREIGN KEY (cristalizacion_id) REFERENCES cristalizacion (id)');
        $this->addSql('CREATE INDEX IDX_1D9BA97F18602F65 ON mineral (cristalizacion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mineral DROP FOREIGN KEY FK_1D9BA97F18602F65');
        $this->addSql('DROP TABLE cristalizacion');
        $this->addSql('DROP INDEX IDX_1D9BA97F18602F65 ON mineral');
        $this->addSql('ALTER TABLE mineral DROP cristalizacion_id');
    }
}
