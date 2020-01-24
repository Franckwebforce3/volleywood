<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200124125428 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(160) NOT NULL, description LONGTEXT NOT NULL, photo VARCHAR(160) NOT NULL, categorie LONGTEXT NOT NULL, date_publication DATETIME NOT NULL, photo2 VARCHAR(160) DEFAULT NULL, photo3 VARCHAR(160) DEFAULT NULL, photo4 VARCHAR(160) DEFAULT NULL, apercu VARCHAR(160) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, etat INT NOT NULL, date_livraison DATETIME NOT NULL, refcommande VARCHAR(160) NOT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_produit (id INT AUTO_INCREMENT NOT NULL, commandes_id INT DEFAULT NULL, produits_id INT DEFAULT NULL, quantite INT NOT NULL, taille VARCHAR(3) DEFAULT NULL, INDEX IDX_DF1E9E878BF5C2E6 (commandes_id), INDEX IDX_DF1E9E87CD11A2CF (produits_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, poce_bleu INT DEFAULT NULL, message LONGTEXT NOT NULL, id_parent INT DEFAULT NULL, date_publication DATETIME NOT NULL, INDEX IDX_67F068BC67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_article (commentaire_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_71F29C35BA9CD190 (commentaire_id), INDEX IDX_71F29C357294869C (article_id), PRIMARY KEY(commentaire_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, produits_id INT DEFAULT NULL, quantite INT NOT NULL, UNIQUE INDEX UNIQ_54AF5F27CD11A2CF (produits_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, nom VARCHAR(160) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_14B78418F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(160) NOT NULL, description LONGTEXT NOT NULL, categorie VARCHAR(160) NOT NULL, taille VARCHAR(160) DEFAULT NULL, couleur VARCHAR(160) DEFAULT NULL, prix_vente NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(160) DEFAULT NULL, avatar VARCHAR(160) DEFAULT NULL, ville VARCHAR(160) DEFAULT NULL, cp VARCHAR(5) DEFAULT NULL, adresse VARCHAR(160) DEFAULT NULL, cle_activation VARCHAR(160) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E878BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire_article ADD CONSTRAINT FK_71F29C35BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_article ADD CONSTRAINT FK_71F29C357294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE magasin ADD CONSTRAINT FK_54AF5F27CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire_article DROP FOREIGN KEY FK_71F29C357294869C');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E878BF5C2E6');
        $this->addSql('ALTER TABLE commentaire_article DROP FOREIGN KEY FK_71F29C35BA9CD190');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87CD11A2CF');
        $this->addSql('ALTER TABLE magasin DROP FOREIGN KEY FK_54AF5F27CD11A2CF');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418F347EFB');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC67B3B43D');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE commentaire_article');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE user');
    }
}
