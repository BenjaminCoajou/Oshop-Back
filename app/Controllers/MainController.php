<?php

namespace App\Controllers;



use App\Models\Category;
use App\Models\Product;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $category = new Category();
        $categoryToDisplay = $category->findAll();

        $product = new Product();
        $productToDisplay = $product->findAll();
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home',['category' => $categoryToDisplay, 'product' => $productToDisplay]);
    }

    public function add()
    {
        
    }

    public function list()
    {
        
    }

    public function update($id)
    {
        
    }

    public function delete($id)
    {
        
    }


    

}
