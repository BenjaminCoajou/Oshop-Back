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
        global $match;
        $currentRoute = $match['name'];

        // inclure l'acl (acces control list)
        require __DIR__ . '/../acl.php';
        // Si la route est présente dans la liste des routes pour lesquelles on prévoit un controle
        if(array_key_exists($currentRoute, $controlList)){
            // on lance checkAutorization()
            $this->checkAutorization($controlList[$currentRoute]);
        }

        // Gestion du token CSRF
        // Lister les méthode de controllers qui font une action sensible
        $csrfTokenToCheckInGet = [
            'category-delete',
            'user-delete',
            'product-delete'
        ];

        $csrfTokenToCheckInPost = [
            'category-addpost',
            'category-updatepost',
            'user-addpost',
            'user-updatepost',
            'product-addpost',
            'product-updatepost'
        ];
        // Si la méthode est dans la liste des action à protéger contre la faille CSRF, on vérifi le token
        if(in_array($currentRoute, $csrfTokenToCheckInGet)){
            // La route courante est à protéger des attaques CSRF
            if($_GET['csrf-token'] !== $_SESSION['csrf-token']){
                http_response_code(403);
                exit('Dégage pirate. Tu vas tâter de mon épée.');
            };
        }
        // Même chose en POST
        if(in_array($currentRoute, $csrfTokenToCheckInPost)){
            // La route courante est à protéger des attaques CSRF
            if($_POST['csrf-token'] !== $_SESSION['csrf-token']){
                http_response_code(403);
                exit('Dégage pirate. Tu vas tâter de mon épée.');
            };
        }
    }

    protected function checkAutorization($roles = [])
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

        // On génére un token si inexitant
        if(!isset($_SESSION['csrf-token'])){
            $viewVars['csrfToken'] = bin2hex(random_bytes(32));
            $_SESSION['csrf-token'] = $viewVars['csrfToken'];
        }
        else{
            $viewVars['csrfToken'] = $_SESSION['csrf-token'];
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
