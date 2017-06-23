<h2 class="center">Page mediatheque</h2>
<br />
<?php if(isset($movies)): ?>
    <?php foreach ($movies as $movie): ?>
        <?php $fav = 0; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= utf8_encode($movie->title); ?>
                <div class="hover-fav"><span data-id="<?= $movie->code; ?>" style="font-size: 1.4em; float:right;" id="del" class="delete glyphicon glyphicon-heart active" aria-hidden="true"></span></div>
               
                <?php if($user->getType() == 'ROLE_ADMIN'): ?>
                    <?php foreach ($user->getMediatheque() as $usermovie):?>
                    <?php if($usermovie->getCodeFilm() == $movie->code): ?>
                        <?php if(!empty($usermovie->getGroupe())): ?>
                            <?php $fav = 1; ?>
                            <div class="hover-grp"><span data-id="<?= $movie->code; ?>" style="font-size: 1.4em; float:right;" id="addgrp" class="addgrp glyphicon glyphicon-user active" aria-hidden="true"></span></div>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($fav == 0): ?>
                        <div class="hover-grp"><span data-id="<?= $movie->code; ?>" style="font-size: 1.4em; float:right;" id="delgrp" class="addgrp glyphicon glyphicon-user" aria-hidden="true"></span></div>
                    <?php endif; ?>
                <?php endif; ?>
                
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-xs-12"><img src="<?= $movie->poster->getImagePath() ?>" height="150" ></div>
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
<script>
    $('.delete').click(function(){
        if (confirm('Retirer de vos favoris ?')) {
            var id_del = $(this).data('id');
            $.ajax
            ({
                data: {"id_del": id_del},
                type: 'post'
            });
            $(this).parent().parent().hide();
        }
    });
</script>
<script>
    $('.addgrp').click(function(){
        if (confirm('Ajouter à votre groupe ?')) {
            var id_addgrp = $(this).data('id');
            $.ajax
            ({
                data: {"id_addgrp": id_addgrp},
                type: 'post'
            });
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        }
    });
    $('.delgrp').click(function(){
        if (confirm('Supprimer de votre groupe ?')) {
            var id_delgrp = $(this).data('id');
            $.ajax
            ({
                data: {"id_delgrp": id_delgrp},
                type: 'post'
            });
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        }
    });
</script>