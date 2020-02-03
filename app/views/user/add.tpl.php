
<div class="container my-4">
    <a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un produit</h2>

    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="adresse e-mail">
        </div>
        <div class="form-group">
            <label for="description">mot de passe</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="mot de passe" aria-describedby="subtitleHelpBlock">

        </div>
        <div class="form-group">
            <label for="picture">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" aria-describedby="pictureHelpBlock">

        </div>
        <div class="form-group">
            <label for="price">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Prix du produit
            </small>
        </div>

        <div class="form-group">
            <label for="brandId">Role</label>
            <select id="role" name="role">
                <option selected value="0"></option>

                <option value="">admin</option>
                <option value="">catalog-manager</option>

            </select>

        </div>
        <div class="form-group">
            <label for="categoryId">Statut</label>
            <select id="status" name="status">
                <option selected value="0"></option>

                <option value="1">actif</option>
                <option value="2">désactivé/bloqué</option>

            </select>

        </div>

        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>