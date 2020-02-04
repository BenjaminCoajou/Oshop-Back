<?php

namespace App\Controllers;

abstract class CoreController {

    abstract public function add();
    abstract public function list();
    abstract public function update($id);
    abstract public function delete($id);


    public function __construct()
    {
        // Récupération de l'action à faire (nom de la route)

        // Définition du role qui est attribut à chaque route (liste)
        // On liste les routes où il faut un controle []
        // Pour chaque route on donne la liste des role qui peuvent y accéder

        // Si la route est présente dans la liste des routes pour lesquelles on prévoit un controle
            // on lance checkAutorization()
    }

    protected function chechAutorization($roles = [])
    {
        global $router;

        if(isset($_SESSION['userId']) && isset($_SESSION['userObject'])){
            if(in_array($_SESSION['userObject']->getRole(), $roles)){
                return true;
            }
            else{                
                http_response_code(403);
                exit();
            }
        }
        else{
            header('Location:' . $router->generate('user-login'));
        }
    }


    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . '/assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        if(isset($_SESSION['flashMessages'])){
            $viewVars['flashMessages'] = $_SESSION['flashMessages'];
            unset($_SESSION['flashMessages']);
        } else{
            $viewVars['flashMessages'] = [];
        }

        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau
        
        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }
}
