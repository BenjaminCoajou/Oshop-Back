<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController {

    
    public function add(){
        $this->chechAutorization(['admin']);
        
        $this->show('user/add');
    }

    public function list(){
        
        $this->chechAutorization(['admin']);

        $userList = AppUser::findAll();

        $this->show('user/list',['userList' => $userList]);
    
    }

    public function addPost()
    {
        $this->chechAutorization(['admin']);

        global $router;

        // valider les données en POST
        // préparer un array pour stocker les erreurs
        $errors = [];

        // syntaxe condensée :
        // if (! ($email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
        //     // sinon on le jette (poliment)
        //     $_SESSION['flashMessages'] = 'Veuillez entrer un email';
        //     header('Location: ' . $router->generate('user-add'));
        // }
        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        }else {
            $errors[] = 'Veuillez entrer un email';
        }

        if (filter_input(INPUT_POST, 'firstname')) {
            $firstName = $_POST['firstname'];
        }else {
            $errors[] = 'Veuillez entrer un prénom';
        }

        if (filter_input(INPUT_POST, 'lastname')) {
            $lastName = $_POST['lastname'];
        }else {
            $errors[] = 'Veuillez entrer un nom';
        }

        if (filter_input(INPUT_POST, 'password')) {
            $password = $_POST['password'];
        }else {
            $errors[] = 'Veuillez entrer un mot de passe';
        }

        // vérification de la correspondance du mot de passe saisi et de la confirmation de mot de passe saisie
        if (empty($_POST['password-confirm']) || $password !== $_POST['password-confirm']) {
            $errors[] = 'La confirmation de mot de passe doit correspondre au mot de passe saisi';
        }

        if (filter_input(INPUT_POST, 'role')) {
            $role = $_POST['role'];
        } else {
            $errors[] = 'Veuillez choisir un rôle';
        }

        if (filter_input(INPUT_POST, 'status')) {
            $status = $_POST['status'];
        } else {
            $errors[] = 'Veuillez spécifier un status';
        }

        // vérifier la présence d'erreurs générées au dessus
        if (count($errors) > 0) {
        // si erreurs
            // préparer des flashMessages
            $_SESSION['flashMessages'] = $errors;
            // redirection vers le formulaire
            header('Location: ' . $router->generate('user-add'));
            // arrêt du script
            exit();
        }
        
        // instancier un nouveau model AppUser
        $user = new AppUser();
        // hasher le mot de passe
        $password = password_hash($password, PASSWORD_DEFAULT);
        // l'hydrater => donner des valeurs à ses propriétés
        $user->setEmail($email);
        $user->setFirstname($firstName);
        $user->setLastname($lastName);
        $user->setPassword($password);
        $user->setRole($role);
        $user->setStatus($status);

        

        // Déclenchement de l'enregistrement
        $success = $user->insert();

        if($success) {
            // Redirection vers la page liste catégorie
            $redirect = $router->generate('user-list');           
        }
        else {
             // Redirection vers la page ajout catégorie
             $_SESSION['flashMessages'] = ["Le nouvel utilisateur {$user->getFirstname()} {$user->getLastname()} n'a pu être ajouté."];
             $redirect = $router->generate('user-add');          
        }
        header("Location: " . $redirect);
        exit(); // facultatif car pas de code à éxécuter plus loin
    }

    public function update($id){}
    public function delete($id){}

    public function login()
    {
        $this->show('user/login');
    }

    public function loginPost()
    {
        global $router;

        if(filter_input(INPUT_POST, 'email')) {
            $email = $_POST['email'];
        }

        if(filter_input(INPUT_POST, 'password')) {
            $password = $_POST['password'];
        }

        $user = AppUser::findByEmail($email);

        if(!$user){
            $_SESSION['flashMessages'] = ['Utilisateur incorrect'];
            header('Location: ' . $router->generate('user-login'));
        }
        else{
            $passwordVerified = password_verify($password, $user->getPassword());
             if($passwordVerified !== false){
                 
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;
                header('Location: ' . $router->generate('main-home'));
             }
             else{
                 $_SESSION['flashMessages'] = ['Mot de passe incorrect'];
                header('Location: ' . $router->generate('user-login'));
             }
        }
    }

    public function logout()
    {
        global $router;
        
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        header('Location: ' . $router->generate('user-login'));
    }

}