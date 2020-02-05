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

    public function homeCategories()
    {
        $categoryList = Category::findAll();
        
        $this->show('main/home_categories',[
            'categoryList' => $categoryList            
        ]);
    }

    public function homeCategoriesPost()
    {
        
        global $router;

        // Vérification des données reçues
        if(!filter_input_array(INPUT_POST, ['emplacement' => FILTER_VALIDATE_INT])){
            exit('Erreur donnés');
        }

        $emplacement = $_POST['emplacement'];
        

        // Mettre à 0 le champ home_order
        $homeOrderReset = Category::resetAllHomeOrder();

        if($homeOrderReset){
            // Maj de home_order via le POST

            foreach($emplacement as $homeOrder => $categoryId){

                // Si pas de valeur pour $categoryId (select vide)
                if(empty($categoryId)){
                    // On passer au tour de boucle suivant
                    continue;
                }

                // homeOrder doit être incrémenté pour correspondre à une valeur utilisable pour le champ home_order
                $homeOrder++;

                // Charger le model de la catégorie courante 
                $currentCategory = Category::find($categoryId);
                // Modifier la valeur de home order pour la catégorie
                $currentCategory->setHomeOrder($homeOrder);

                $currentCategory->update();
            }

        }

        // Redirection vers le formulaire
        header('Location:' . $router->generate('main-home-categories'));
        exit();
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
