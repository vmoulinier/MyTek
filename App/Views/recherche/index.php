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
            <?php $fav = 0 ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= utf8_encode($movie->title); ?>
                    <?php foreach ($user->getMediatheque() as $usermovie):?>
                        <?php if($usermovie->getCodeFilm() == $movie->code): ?>
                            <?php $fav = 1; ?>
                            <span data-id="<?= $movie->code; ?>" style="font-size: 1.4em; float:right;" id="add" class="delete glyphicon glyphicon-heart active" aria-hidden="true"></span>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($fav == 0): ?>
                        <span data-id="<?= $movie->code; ?>" style="font-size: 1.4em; float:right;" id="del" class="add glyphicon glyphicon-heart" aria-hidden="true"></span>
                    <?php endif; ?>
                </div>
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
        <?php endforeach; ?>

    <?php endif; ?>
<?php endif; ?>
<script>
    $('.add').click(function(){

        var id_add = $(this).data('id');
        $.ajax
        ({
            data: {"id_add": id_add},
            type: 'post'
        });
        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });

    $('.delete').click(function(){
        var id_del = $(this).data('id');
        $.ajax
        ({
            data: {"id_del": id_del},
            type: 'post'
        });
        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
</script>

