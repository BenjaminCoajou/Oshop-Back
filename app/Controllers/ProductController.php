<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController extends CoreController{

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
        $this->show('product/add');
    }

    public function update($productId)
    {
        $productAdd = Product::find($productId);
        $this->show('product/update', ["productAdd" => $productAdd]);
    }
}

?>