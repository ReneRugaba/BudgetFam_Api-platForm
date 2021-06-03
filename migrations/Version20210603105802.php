<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603105802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cathegories_depenses (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depenses (id INT AUTO_INCREMENT NOT NULL, cathegories_depenses_id INT NOT NULL, members_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date_paiement DATETIME NOT NULL, beneficiaire VARCHAR(255) NOT NULL, INDEX IDX_EE350ECB4DD52016 (cathegories_depenses_id), INDEX IDX_EE350ECBBD01F5ED (members_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE members (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_45A0D2FFE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revenus (id INT AUTO_INCREMENT NOT NULL, types_revenus_id INT NOT NULL, members_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date_reception DATETIME NOT NULL, INDEX IDX_1DC5D9D4625CA138 (types_revenus_id), INDEX IDX_1DC5D9D4BD01F5ED (members_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soldes_revenus_depenses (id INT AUTO_INCREMENT NOT NULL, members_id INT NOT NULL, revenu_total DOUBLE PRECISION NOT NULL, total_depenses DOUBLE PRECISION NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_E7F141CBD01F5ED (members_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_revenus (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depenses ADD CONSTRAINT FK_EE350ECB4DD52016 FOREIGN KEY (cathegories_depenses_id) REFERENCES cathegories_depenses (id)');
        $this->addSql('ALTER TABLE depenses ADD CONSTRAINT FK_EE350ECBBD01F5ED FOREIGN KEY (members_id) REFERENCES members (id)');
        $this->addSql('ALTER TABLE revenus ADD CONSTRAINT FK_1DC5D9D4625CA138 FOREIGN KEY (types_revenus_id) REFERENCES types_revenus (id)');
        $this->addSql('ALTER TABLE revenus ADD CONSTRAINT FK_1DC5D9D4BD01F5ED FOREIGN KEY (members_id) REFERENCES members (id)');
        $this->addSql('ALTER TABLE soldes_revenus_depenses ADD CONSTRAINT FK_E7F141CBD01F5ED FOREIGN KEY (members_id) REFERENCES members (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE depenses DROP FOREIGN KEY FK_EE350ECB4DD52016');
        $this->addSql('ALTER TABLE depenses DROP FOREIGN KEY FK_EE350ECBBD01F5ED');
        $this->addSql('ALTER TABLE revenus DROP FOREIGN KEY FK_1DC5D9D4BD01F5ED');
        $this->addSql('ALTER TABLE soldes_revenus_depenses DROP FOREIGN KEY FK_E7F141CBD01F5ED');
        $this->addSql('ALTER TABLE revenus DROP FOREIGN KEY FK_1DC5D9D4625CA138');
        $this->addSql('DROP TABLE cathegories_depenses');
        $this->addSql('DROP TABLE depenses');
        $this->addSql('DROP TABLE members');
        $this->addSql('DROP TABLE revenus');
        $this->addSql('DROP TABLE soldes_revenus_depenses');
        $this->addSql('DROP TABLE types_revenus');
    }
}
