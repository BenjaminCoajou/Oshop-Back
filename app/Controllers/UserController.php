<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController {

    
    public function add(){}
    public function list(){}
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