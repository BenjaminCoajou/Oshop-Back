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
        // Récupère les valeurs que si elles existent en POST
       $email = filter_input(INPUT_POST, 'email');
       $password = filter_input(INPUT_POST, 'password');
       $firstname = filter_input(INPUT_POST, 'firstname');
       $lastname = filter_input(INPUT_POST, 'lastname');
       $role = filter_input(INPUT_POST, 'role');
       $status = filter_input(INPUT_POST, 'status');

        
        // Création du model
        $user = new AppUser();
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
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
            $_SESSION['flashMessages'] = 'Utilisateur incorrect';
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
                 $_SESSION['flashMessages'] = 'Mot de passe incorrect';
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