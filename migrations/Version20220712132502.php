<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712132502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rel_section_branche ADD id_branche INT NOT NULL');
        $this->addSql('ALTER TABLE rel_section_branche ADD CONSTRAINT FK_12F06842BCF458C4 FOREIGN KEY (id_branche) REFERENCES branche (id_branche)');
        $this->addSql('CREATE INDEX IDX_12F06842BCF458C4 ON rel_section_branche (id_branche)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rel_section_branche DROP FOREIGN KEY FK_12F06842BCF458C4');
        $this->addSql('DROP INDEX IDX_12F06842BCF458C4 ON rel_section_branche');
        $this->addSql('ALTER TABLE rel_section_branche DROP id_branche');
    }
}
