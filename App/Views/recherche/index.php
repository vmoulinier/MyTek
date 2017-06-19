<h2 class="center">Page recherche</h2>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form method="post">
            <?= $form->input('titre', 'Titre du film'); ?>
            <?= $form->submit('Rechercher'); ?>
        </form>
    </div>
</div>
<?php if(isset($movies)): ?>
    <?php  if (!$movies or count($movies->movie) < 1): ?>
        <h2 class="center">Aucun résultat pour cette recherche.</h2>
    <?php else: ?>
        <?php foreach ($movies->movie as $movie): ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?= utf8_encode($movie->title); ?></div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-xs-12"><img src="<?= $movie->posterURL ?>" height="150" ></div>
                                </div>
                            </td>
                            <td valign="top" style="padding: 5px">
                                <div class="row">
                                    <div class="col-xs-12"><?= $movie->productionYear ?></div>
                                    <div class="col-xs-12">de :  <b><?= utf8_encode($movie->castingShort->directors) ?></b></div>
                                    <div class="col-xs-12">avec : <b><?= utf8_encode($movie->castingShort->actors) ?></b></div>
                                    <div class="col-xs-12">presse : <b><?= round($movie->statistics->pressRating, 1) ?>/5</b></div>
                                    <div class="col-xs-12">spectateurs : <b><?= round($movie->statistics->userRating, 1) ?>/5</b></div>
                                    <div class="col-xs-12"><a target="_blank" href="<?= $movie->link[0]->href ?>">Fiche du film</a></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
<!--            --><?php //var_dump($movie) ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>