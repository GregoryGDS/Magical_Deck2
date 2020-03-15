<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200315223548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_deck (id INT AUTO_INCREMENT NOT NULL, id_deck_id INT NOT NULL, id_card_id INT NOT NULL, INDEX IDX_A39F3495CF84E1AC (id_deck_id), INDEX IDX_A39F349594513350 (id_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cards (id INT AUTO_INCREMENT NOT NULL, id_type_id INT NOT NULL, id_creator_id INT NOT NULL, id_faction_id INT NOT NULL, rarity_id INT DEFAULT NULL, hp INT DEFAULT NULL, attack INT DEFAULT NULL, shield INT DEFAULT NULL, name VARCHAR(255) NOT NULL, cost INT NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(500) NOT NULL, full_art TINYINT(1) NOT NULL, INDEX IDX_4C258FD1BD125E3 (id_type_id), INDEX IDX_4C258FDC4A88E71 (id_creator_id), INDEX IDX_4C258FDE1C2780D (id_faction_id), INDEX IDX_4C258FDF3747573 (rarity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decks (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A3FCC63279F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rarity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, card_color VARCHAR(255) NOT NULL, stats TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card_deck ADD CONSTRAINT FK_A39F3495CF84E1AC FOREIGN KEY (id_deck_id) REFERENCES decks (id)');
        $this->addSql('ALTER TABLE card_deck ADD CONSTRAINT FK_A39F349594513350 FOREIGN KEY (id_card_id) REFERENCES cards (id)');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FD1BD125E3 FOREIGN KEY (id_type_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDC4A88E71 FOREIGN KEY (id_creator_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDE1C2780D FOREIGN KEY (id_faction_id) REFERENCES factions (id)');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDF3747573 FOREIGN KEY (rarity_id) REFERENCES rarity (id)');
        $this->addSql('ALTER TABLE decks ADD CONSTRAINT FK_A3FCC63279F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDC4A88E71');
        $this->addSql('ALTER TABLE decks DROP FOREIGN KEY FK_A3FCC63279F37AE5');
        $this->addSql('ALTER TABLE card_deck DROP FOREIGN KEY FK_A39F349594513350');
        $this->addSql('ALTER TABLE card_deck DROP FOREIGN KEY FK_A39F3495CF84E1AC');
        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDE1C2780D');
        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDF3747573');
        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FD1BD125E3');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE card_deck');
        $this->addSql('DROP TABLE cards');
        $this->addSql('DROP TABLE decks');
        $this->addSql('DROP TABLE factions');
        $this->addSql('DROP TABLE rarity');
        $this->addSql('DROP TABLE types');
    }
}
