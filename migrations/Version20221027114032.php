<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027114032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE franchises (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, ville VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', structure_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_C0D3F013A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modules (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permissions_modules (id INT AUTO_INCREMENT NOT NULL, modules_id INT NOT NULL, structures_id INT NOT NULL, franchises_id INT NOT NULL, who VARCHAR(100) NOT NULL, is_permit TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CB0206AB60D6DC42 (modules_id), INDEX IDX_CB0206AB9D3ED38D (structures_id), INDEX IDX_CB0206AB7347BA0A (franchises_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structures (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, adresse VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_5BBEC55AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE franchises ADD CONSTRAINT FK_C0D3F013A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE permissions_modules ADD CONSTRAINT FK_CB0206AB60D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE permissions_modules ADD CONSTRAINT FK_CB0206AB9D3ED38D FOREIGN KEY (structures_id) REFERENCES structures (id)');
        $this->addSql('ALTER TABLE permissions_modules ADD CONSTRAINT FK_CB0206AB7347BA0A FOREIGN KEY (franchises_id) REFERENCES franchises (id)');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchises DROP FOREIGN KEY FK_C0D3F013A76ED395');
        $this->addSql('ALTER TABLE permissions_modules DROP FOREIGN KEY FK_CB0206AB60D6DC42');
        $this->addSql('ALTER TABLE permissions_modules DROP FOREIGN KEY FK_CB0206AB9D3ED38D');
        $this->addSql('ALTER TABLE permissions_modules DROP FOREIGN KEY FK_CB0206AB7347BA0A');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55AA76ED395');
        $this->addSql('DROP TABLE franchises');
        $this->addSql('DROP TABLE modules');
        $this->addSql('DROP TABLE permissions_modules');
        $this->addSql('DROP TABLE structures');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
