<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    private $home_order;

    /**
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * @return  self
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * @return  self
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;

        return $this;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     * 
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
    static public function find($categoryId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `category` WHERE `id` =' . $categoryId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $category = $pdoStatement->fetchObject(self::class);

        // retourner le résultat
        return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     * 
     * @return Category[]
     */
    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        // self::class renvoie le nom complet (namespace compris) de la classe courante
        // self est une référence à la classe courante comme $this est une référence à l'objet courant
        return $results;
    }

    /**
     * Récupérer les 5 catégories mises en avant sur la home
     * 
     * @return Category[]
     */
    static public function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            WHERE home_order > 0
            ORDER BY home_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $categories;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Enregistrement d'une nouvelle catégorie
     * 
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        $statement = $pdo->prepare("INSERT INTO `category` (`name`, `subtitle`, `picture`)
            VALUES (:name, :subtitle, :picture)");
        
        // Execution de la requête d'insertion
        $success = $statement->execute([
            ':name'=> $this->name,
            ':subtitle' => $this->subtitle,
            ':picture'=> $this->picture
        ]);

        
        // return !!$insertedRows;
        // return $insertedRows > 0;
        // Si au moins une ligne ajoutée
        if ($success === true) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();
        }
       
        return $success;
    }

    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE SET
        $sql = "
        UPDATE `category`
            SET
                name = :name,
                subtitle = :subtitle,
                picture = :picture,
                home_order = :home_order,
                updated_at = NOW()
            WHERE id = :id
        ";

        $statement = $pdo->prepare($sql);
        
        // Execution de la requête d'insertion
        return $statement->execute([
            ':id' => $this->id,
            ':name' => $this->name,
            ':subtitle' => $this->subtitle,
            ':picture'=> $this->picture,
            'home_order'=> $this->home_order
        ]);

    }

    public function delete()
    {
       // récupérer une connexion PDO
       $pdo = Database::getPDO();

       $sql = "
           DELETE FROM `category`
           WHERE `id` = :id
       ";

       // préparer la requête
       $statement = $pdo->prepare($sql);

       // exécution de la requête avec les valeurs de l'objet courant $this
       $success = $statement->execute([
           ':id' => $this->id
       ]);

       return $success; 
    }

    static public function resetAllHomeOrder()
    {
        $pdo = Database::getPDO();

       $sql = "
            UPDATE `category`
            SET
            `home_order` = 0
       ";

       // préparer la requête
       $statement = $pdo->prepare($sql);

       // exécution de la requête avec les valeurs de l'objet courant $this
       $success = $statement->execute();

       return $success; 
    }
}
