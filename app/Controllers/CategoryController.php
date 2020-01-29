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

}

?>