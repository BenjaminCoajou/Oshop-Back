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

    public function addPost()
    {
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');
        $description = filter_input(INPUT_POST, 'description');
        $brand_id = filter_input(INPUT_POST, 'brand_id');
        $category_id = filter_input(INPUT_POST, 'category_id');
        $type_id = filter_input(INPUT_POST, 'type_id');



        $post = new Product();
        $post->setName($name);
        $post->setPrice($price);
        $post->setDescription($description);
        $post->setBrandId($brand_id);
        $post->setCategoryId($category_id);
        $post->setTypeId($type_id);

        $post->insert();
        header('Location: http://localhost/S06/s06-oshop-BenjaminCoajou/public/product/list/');
        exit;

    }

}