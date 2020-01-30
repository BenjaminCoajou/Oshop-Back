<div class="container my-4">
    <a href="<?= $router->generate('product-list')?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un produit</h2>
    
    <form action="<?= $router->generate('product-addpost')?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom du produit">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="description" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                La description du produit
            </small>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Prix" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Prix du produit
            </small>
        </div>
        <div class="form-group">
            <label for="status">Le status du produit</label>
            <input type="text" class="form-control" id="status" name="status" placeholder="Status du produit" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                le status du produit (1 dispo | 2 pas dispo)
            </small>
        </div>
        <div class="form-group">
            <label for="brandId">numéro d'identification de la marque</label>
            <input type="text" class="form-control" id="brandId" name="brandId" placeholder="ID de la marque" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                ID de la marque (Numéro uniquement). Exemple: BOOTstrap = 2
            </small>
        </div>
        <div class="form-group">
            <label for="categoryId">numéro d'identification de la catégorie</label>
            <input type="text" class="form-control" id="categoryId" name="categoryId" placeholder="ID de la catégorie" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                ID de la catégorie (Numéro uniquement). Exemple: Sortir = 4
            </small>
        </div>
        <div class="form-group">
            <label for="typeId">numéro d'identification du type</label>
            <input type="text" class="form-control" id="typeId" name="typeId" placeholder="ID du type de produit" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
            ID du type de produit (Numéro uniquement). Exemple: Tongs = 3
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>