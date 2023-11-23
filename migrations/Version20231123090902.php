<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123090902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE branche (id_branche INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id_branche)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rel_section_branche (id_rel_sec_bra INT AUTO_INCREMENT NOT NULL, id_branche INT NOT NULL, horsect VARCHAR(12) NOT NULL, libelle VARCHAR(100) NOT NULL, INDEX IDX_12F06842BCF458C4 (id_branche), PRIMARY KEY(id_rel_sec_bra)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rel_section_branche ADD CONSTRAINT FK_12F06842BCF458C4 FOREIGN KEY (id_branche) REFERENCES branche (id_branche)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rel_section_branche DROP FOREIGN KEY FK_12F06842BCF458C4');
        $this->addSql('DROP TABLE branche');
        $this->addSql('DROP TABLE rel_section_branche');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
