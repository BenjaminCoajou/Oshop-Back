
<div class="container my-4">
    <a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un utilisateur</h2>

    <?php  include __DIR__ . '/../partials/flash_messages.tpl.php'?>

    <form action="<?= $router->generate('user-addpost') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="adresse e-mail">
        </div>
        <div class="form-group">
            <label for="password">mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe" aria-describedby="subtitleHelpBlock">

        </div>
        <div class="form-group">
            <label for="password">confirmation mot de passe</label>
            <input type="password" class="form-control" id="password" name="password-confirm" placeholder="confirmez le mot de passe" aria-describedby="subtitleHelpBlock">

        </div>
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" aria-describedby="pictureHelpBlock">

        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" aria-describedby="subtitleHelpBlock">
            
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
                <option selected value="0"></option>

                <option value="admin">admin</option>
                <option value="catalog-manager">catalog-manager</option>

            </select>

        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select id="status" name="status">
                <option selected value="0"></option>

                <option value="1">actif</option>
                <option value="2">désactivé/bloqué</option>

            </select>

        </div>

        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>