<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201162704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE context (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C53D045F166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, context_id INT DEFAULT NULL, illustration_id INT NOT NULL, title VARCHAR(255) NOT NULL, pitch LONGTEXT NOT NULL, link_github VARCHAR(255) NOT NULL, link_demo VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_2FB3D0EE6B00C1CF (context_id), UNIQUE INDEX UNIQ_2FB3D0EE5926566C (illustration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_techno (project_id INT NOT NULL, techno_id INT NOT NULL, INDEX IDX_2E230596166D1F9C (project_id), INDEX IDX_2E23059651F3C1BC (techno_id), PRIMARY KEY(project_id, techno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE techno (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE6B00C1CF FOREIGN KEY (context_id) REFERENCES context (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE5926566C FOREIGN KEY (illustration_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE project_techno ADD CONSTRAINT FK_2E230596166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_techno ADD CONSTRAINT FK_2E23059651F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE6B00C1CF');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE5926566C');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F166D1F9C');
        $this->addSql('ALTER TABLE project_techno DROP FOREIGN KEY FK_2E230596166D1F9C');
        $this->addSql('ALTER TABLE project_techno DROP FOREIGN KEY FK_2E23059651F3C1BC');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE context');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_techno');
        $this->addSql('DROP TABLE techno');
        $this->addSql('DROP TABLE user');
    }
}
