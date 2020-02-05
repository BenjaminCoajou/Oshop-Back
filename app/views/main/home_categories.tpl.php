<div class="container my-4">
    <a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Gestion de la page accueil</h2>
<form action="" method="POST" class="mt-5">
    <div class="row">
        <?php for($i=1; $i<= 5; $i++) :?>
        <div class="col">
            <div class="form-group">
                <label for="emplacement<?=$i?>">Emplacement #<?=$i?></label>
                <select class="form-control" id="emplacement<?=$i?>" name="emplacement[]">
                    <option value="">choisissez :</option>
                    <?php foreach($categoryList as $category) : 
                        $selected = '';
                        if($category->getHomeOrder() == $i) {
                            $selected = 'selected';}?>?>
                    <option value="<?= $category->getId() ?>" <?= $selected ?>><?= $category->getName() ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <?php endfor ?>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>