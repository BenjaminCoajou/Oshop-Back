<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Type;
use App\Models\Brand;

class ProductController extends CoreController
{

    public function list()
    {
        $productList = Product::findAll();

        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('/product/list', ['productList' => $productList]);
    }

    public function add()
    {
        // récupérer les catégories pour l'affichage du <select>
        $categoryList = Category::findAll();
        // récupérer les types de produits pour l'affichage du <select>
        $typeList = Type::findAll();
        // récupérer les marques pour l'affichage du <select>
        $brandList = Brand::findAll();

        // compact est l'inverse d'extract, on s'en sert pour générer un array à partir de variables :
        // on fournit les noms (attention, sous forme de string) des variables à ajouter à l'array 
        // les clés de ces valeurs seront les noms des variables
        $viewVars = compact('categoryList', 'typeList', 'brandList');
        $this->show('product/add', $viewVars);
        // équivaut à :
        // $this->show('product/add', [
        //     'categoryList' => $categoryList,
        //     'typeList' => $typeList,
        //     'brandList' => $brandList
        // ]);
    }

    public function update($productId)
    {
        $categoryList = Category::findAll();
        
        $typeList = Type::findAll();
        
        $brandList = Brand::findAll();

        $product = Product::find($productId);

        $tagList = $product->findTagsForProduct();
        
        $viewVars = compact('categoryList', 'typeList', 'brandList', 'product', 'tagList');
        
        $this->show('product/update', $viewVars);
    }

    public function addPost()
    {
        //beurk, mais très bien pour l'instant
        global $router;

        // récupération des valeurs saisies en POST
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        // FILTER_SANITIZE_MAGIC_QUOTES => gérer les apostrophes 
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_MAGIC_QUOTES);
        $picture = filter_input(INPUT_POST, 'picture');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $brandId = filter_input(INPUT_POST, 'brandId', FILTER_VALIDATE_INT);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
        $typeId = filter_input(INPUT_POST, 'typeId', FILTER_VALIDATE_INT);

        // création du model
        $product = new Product();
        // hydrater le modèle : lui donner les valeurs de ses propriétés
        $product->setName($name);
        $product->setDescription($description);
        $product->setPicture($picture);
        $product->setPrice($price);
        $product->setStatus($status);
        $product->setBrandId($brandId);
        $product->setCategoryId($categoryId);
        $product->setTypeId($typeId);
        
        // déclencher l'enregistrement en bdd
        // on récupère le succes de l'opération
        $success = $product->insert();

        if ($success) {
            // si la requête d'insert a fonctionné
            // redirection vers la page de liste
            $redirect = $router->generate('product-list');
        } else {
            // si la requête d'insert n'a pas fonctionné
            // redirection vers la page d'ajout => on réaffiche le formulaire (avec potentiellement un message d'erreur)
            $redirect = $router->generate('product-add');
        }
        
        header("Location: " . $redirect);
        exit(); // ici exit facultatif, rien ne sera de toute façon exécuté plus loin
    }

    public function updatePost()
    {
        //beurk, mais très bien pour l'instant
        global $router;

        // récupération des valeurs saisies en POST
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        // FILTER_SANITIZE_MAGIC_QUOTES => gérer les apostrophes 
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_MAGIC_QUOTES);
        $picture = filter_input(INPUT_POST, 'picture');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $brandId = filter_input(INPUT_POST, 'brandId', FILTER_VALIDATE_INT);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
        $typeId = filter_input(INPUT_POST, 'typeId', FILTER_VALIDATE_INT);

        // création du model
        $product = Product::find($id);
        // hydrater le modèle : lui donner les valeurs de ses propriétés
        $product->setName($name);
        $product->setDescription($description);
        $product->setPicture($picture);
        $product->setPrice($price);
        $product->setStatus($status);
        $product->setBrandId($brandId);
        $product->setCategoryId($categoryId);
        $product->setTypeId($typeId);
        
        // déclencher l'enregistrement en bdd
        // on récupère le succes de l'opération
        $success = $product->update();

        if ($success) {
            // si la requête d'insert a fonctionné
            // redirection vers la page de liste
            $redirect = $router->generate('product-update', ['productId' => $id]);
        } else {
            // si la requête d'insert n'a pas fonctionné
            // redirection vers la page d'ajout => on réaffiche le formulaire (avec potentiellement un message d'erreur)
            $redirect = $router->generate('product-update', ['productId' => $id]);
        }
        
        header("Location: " . $redirect);
        exit(); // ici exit facultatif, rien ne sera de toute façon exécuté plus loin
    }

    public function delete($productId)
    {
        global $router;

        $product = Product::find($productId);

        $success = $product->delete();

        if($success){

        }
        else{

        }

        // redirection vers la liste
        header('Location: ' . $router->generate('product-list'));
        exit();
    }
}
