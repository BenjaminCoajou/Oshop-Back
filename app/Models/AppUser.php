<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel {

    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;
    

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    
    public function insert()
    {
         // récupérer une connexion PDO
         $pdo = Database::getPDO();

         // préparer la requête
         $statement = $pdo->prepare("
             INSERT INTO `app_user` (
                 `email`,
                 `password`,
                 `firstname`,
                 `lastname`, 
                 `role`,
                 `status`
                 ) 
             VALUES (
                 :email,
                 :password,
                 :firstname,
                 :lastname,
                 :role,
                 :status
                )
         ");
 
         // execution de la requête
         // On peut affecter les valeurs à insérer dans la requête directement en argument de la méthode execute()
         // alternative => $statement->bindParam(':name', $this->name);
         // execute renvoie un bool => true si succes, false si echec
         $success = $statement->execute([
             ':email' => $this->email,
             ':password' => $this->password,
             ':firstname' => $this->firstname,
             ':lastname' => $this->lastname,
             ':role' => $this->role,
             ':status' => $this->status
         ]);
         
         // en cas de succès, on récupère l'id du produit inséré et on l'ajoute à l'objet courant
         if ($success) {
             $this->id = $pdo->lastInsertId();
         } 
 
         return $success;
    
    }
    static public function find($id) {}

    static public function findAll(){
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `app_user`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        // self::class renvoie le nom complet (namespace compris) de la classe courante
        // self est une référence à la classe courante comme $this est une référence à l'objet courant
        return $results;
    }

    public function update(){}
    public function delete(){}

    static public function findByEmail($email)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `app_user` WHERE `email` = :email';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':email' =>$email
        ]);

        $results = $pdoStatement->fetchObject(self::class);
        // self::class renvoie le nom complet (namespace compris) de la classe courante
        // self est une référence à la classe courante comme $this est une référence à l'objet courant
        return $results;
    }

}