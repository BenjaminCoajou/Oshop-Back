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
        
    public function addPost()
    {
        $name = filter_input(INPUT_POST, 'name');
        $subtitle = filter_input(INPUT_POST, 'subtitle');
        $picture = filter_input(INPUT_POST, 'picture');
        
        $post = new Category();
        $post->setName($name);
        $post->setSubtitle($subtitle);
        $post->setPicture($picture);

        $post->insert();
        header('Location: http://localhost/S06/s06-oshop-BenjaminCoajou/public/category/list/');
        exit;
    }

}
