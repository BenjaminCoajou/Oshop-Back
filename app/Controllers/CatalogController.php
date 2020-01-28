<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends CoreController{

    public function category($params)
    {
        $categoryId = $params['categoryId'];

        $categoryModel = new Category();
        $category = $categoryModel->find($categoryId);
        $this->show('catalog/category_add', ["category" => $category]);
    }

    public function list()
    {
        $category = new Category();
        $categoryToDisplay = $category->findAll();

        $this->show('catalog/list',['category' => $categoryToDisplay]);
    }

    public function product()
    {
        $product = new Product();
        $productToDisplay = $product->findAll();        
        
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('catalog/product', ['product' => $productToDisplay]);
    }
    
    //

}

?>