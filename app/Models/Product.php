<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Une instance de Product = un produit dans la base de données
 * Product hérite de CoreModel
 */
class Product extends CoreModel
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var float
     */
    private $price;
    /**
     * @var int
     */
    private $rate;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $brand_id;
    /**
     * @var int
     */
    private $category_id;
    /**
     * @var int
     */
    private $type_id;

    /**
     * Méthode permettant de récupérer un enregistrement de la table Product en fonction d'un id donné
     * 
     * @param int $productId ID du produit
     * @return Product
     */
    static public function find($productId)
    {
        // récupérer un objet PDO = connexion à la BDD
        $pdo = Database::getPDO();

        // on écrit la requête SQL pour récupérer le produit
        $sql = '
            SELECT *
            FROM product
            WHERE id = ' . $productId;

        // query ? exec ?
        // On fait de la LECTURE = une récupration => query()
        // si on avait fait une modification, suppression, ou un ajout => exec
        $pdoStatement = $pdo->query($sql);

        // fetchObject() pour récupérer un seul résultat
        // si j'en avais eu plusieurs => fetchAll
        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table product
     * 
     * @return Product[]
     */
    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `product`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
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
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     */
    public function setRate(int $rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Get the value of brand_id
     *
     * @return  int
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @param  int  $brand_id
     */
    public function setBrandId(int $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Get the value of category_id
     *
     * @return  int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     */
    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of type_id
     *
     * @return  int
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @param  int  $type_id
     */
    public function setTypeId(int $type_id)
    {
        $this->type_id = $type_id;
    }

    public function insert()
    {
        // récupérer une connexion PDO
        $pdo = Database::getPDO();

        // préparer la requête
        $statement = $pdo->prepare("
            INSERT INTO `product` (
                `name`,
                `description`,
                `picture`,
                `price`, 
                `status`,
                `brand_id`,
                `category_id`, 
                `type_id`
            ) 
            VALUES (
                :name,
                :description,
                :picture,
                :price,
                :status,
                :brandId,
                :categoryId,
                :typeId
            )
        ");

        // execution de la requête
        // On peut affecter les valeurs à insérer dans la requête directement en argument de la méthode execute()
        // alternative => $statement->bindParam(':name', $this->name);
        // execute renvoie un bool => true si succes, false si echec
        $success = $statement->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':picture' => $this->picture,
            ':price' => $this->price,
            ':status' => $this->status,
            ':brandId' => $this->brand_id,
            ':categoryId' => $this->category_id,
            ':typeId' => $this->type_id
        ]);
        
        // en cas de succès, on récupère l'id du produit inséré et on l'ajoute à l'objet courant
        if ($success) {
            $this->id = $pdo->lastInsertId();
        } 

        return $success;
    }

    public function update()
    {
        // récupérer une connexion PDO
        $pdo = Database::getPDO();

        // préparer la requête
        $statement = $pdo->prepare("
            UPDATE `product` 
            SET 
            `name` = :name, 
            `description` = :description, 
            `picture` = :picture,
            `price` = :price,
            `rate` = :rate,  
            `status` = :status,
            `brand_id` = :brandId,
            `category_id` = :categoryId, 
            `type_id` = :typeId,  
            `updated_at` = NOW() 
            WHERE `product` . `id` = :id             
        ");

        // Utilisation de bindValue() exemple :
        // $statement->bindValue(':name', $this->name);


        // execution de la requête
        // On peut affecter les valeurs à insérer dans la requête directement en argument de la méthode execute()
        // alternative => $statement->bindParam(':name', $this->name);
        // execute renvoie un bool => true si succes, false si echec
        $success = $statement->execute([
            ':id' => $this->id,
            ':name' => $this->name,
            ':description' => $this->description,
            ':picture' => $this->picture,
            ':price' => $this->price,
            ':rate' => $this->rate,
            ':status' => $this->status,
            ':brandId' => $this->brand_id,
            ':categoryId' => $this->category_id,
            ':typeId' => $this->type_id
        ]);

        return $success;
    }

    public function delete()
    {
        // récupérer une connexion PDO
        $pdo = Database::getPDO();

        $sql = "
            DELETE FROM `product`
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

    public function findTagsForProduct() 
    {
        $pdo = Database::getPDO();

        $sql = "
        SELECT `tag`.`name` AS 'tag_name'
        FROM `product`
        INNER JOIN `product_tag` ON `product_tag`.`product_id` = `product`.`id`
        INNER JOIN `tag` ON `product_tag`.`tag_id` = `tag`.`id`
        WHERE `product`.`id` = :productId";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([
            ':productId' => $this->id
        ]);

        $tags = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
    }
}
