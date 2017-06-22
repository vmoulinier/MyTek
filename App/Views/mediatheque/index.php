<h2 class="center">Page mediatheque</h2>
<br />
<?php if(isset($movies)): ?>
        <?php foreach ($movies as $movie): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= utf8_encode($movie->title); ?>
                    <div class="hover-fav"><span data-id="<?= $movie->code; ?>" style="font-size: 1.4em; float:right;" id="del" class="delete glyphicon glyphicon-heart active" aria-hidden="true"></span></div>
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
        if (confirm('Êtes vous sur ?')) {
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