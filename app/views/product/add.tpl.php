<div class="container my-4">
        <a href="<?= $router->generate('product-list') ?>" class="btn btn-success float-right">Retour</a>
        <h2>Ajouter un produit</h2>
        
        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name ="name" placeholder="Nom du produit">
            </div>
            <div class="form-group">
                <label for="subtitle">Prix</label>
                <input type="text" class="form-control" id="price" name ="price" placeholder="Prix du produit" aria-describedby="priceHelpBlock">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description du produit" aria-describedby="descriptionHelpBlock">
            </div>
            <div class="form-group">
                <label for="brandId">Identifiant Marque</label>
                <input type="text" class="form-control" id="brandId" name ="brand_id" placeholder="Identifiant de la marque du produit">
            </div>
            <div class="form-group">
                <label for="categoryId">Identifiant Categorie</label>
                <input type="text" class="form-control" id="categoryId" name ="category_id" placeholder="Identifiant de la categorie du produit">
            </div>
            <div class="form-group">
                <label for="typeId">Identifiant Type</label>
                <input type="text" class="form-control" id="typeId" name ="type_id" placeholder="Identifiant du type du produit">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>