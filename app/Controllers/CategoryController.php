<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends CoreController{

    // Page liste catégories
    public function list()
    {
        $categoryList = Category::findAll();

        $this->show('category/list',['categoryList' => $categoryList]);
    }

    // Page ajout catégories
    public function add()
    {
        $this->show('category/add');
    }
        
    // Page update catégories
    public function update($categoryId)
    {
        $category = Category::find($categoryId);
        $this->show('category/update', ["categoryAdd" => $category]);
    }
    
    // Récupération des données envoyées par le formulaire en post
    public function addPost()
    {
        global $router;
        // Récupère les valeurs que si elles existent en POST
        if(filter_input(INPUT_POST, 'name')){
            $name = $_POST['name'];
        }

        if(filter_input(INPUT_POST, 'subtitle')){
            $subtitle = $_POST['subtitle'];
        }

        if(filter_input(INPUT_POST, 'picture')){
            $picture = $_POST['picture'];
        }
        
        // Création du model
        $post = new Category();
        $post->setName($name);
        $post->setSubtitle($subtitle);
        $post->setPicture($picture);

        // Déclenchement de l'enregistrement
        $success = $post->insert();

        if($success) {
            // Redirection vers la page liste catégorie
            $redirect = $router->generate('category-list');           
        }
        else {
             // Redirection vers la page ajout catégorie
            $redirect = $router->generate('category-add');          
        }
        header("Location: " . $redirect);
        exit(); // facultatif car pas de code à éxécuter plus loin
    }

    public function updatePost()
    {
        global $router;
        // Récupère les valeurs que si elles existent en POST
        if(filter_input(INPUT_POST, 'id')){
            $id = $_POST['id'];
        }

        if(filter_input(INPUT_POST, 'name')){
            $name = $_POST['name'];
        }

        if(filter_input(INPUT_POST, 'subtitle')){
            $subtitle = $_POST['subtitle'];
        }

        if(filter_input(INPUT_POST, 'picture')){
            $picture = $_POST['picture'];
        }

        
        // Récupération du model
        $post = Category::find($id);
        $post->setName($name);
        $post->setSubtitle($subtitle);
        $post->setPicture($picture);

        // Déclenchement de l'enregistrement
        $success = $post->update();

        if($success) {
            // Redirection vers la page liste catégorie
            $redirect = $router->generate('category-update', ['categoryId' => $id]);           
        }
        else {
             // Redirection vers la page ajout catégorie
             exit('Erreur d\'insertion');
            $redirect = $router->generate('category-update', ['categoryId' => $id]);          
        }
        header("Location: " . $redirect);
        exit(); // facultatif car pas de code à éxécuter plus loin
    }

}



