<h2 class="center">Page groupes</h2>
<br />
Votre groupe :
<br />
<a href="infos/<?= $groupeuser->getId(); ?>"><?= $groupeuser->getNom(); ?></a>
<br/>
Tous les groupes :
<br />
<?php foreach ($groupes as $groupe): ?>
<a href="infos/<?= $groupeuser->getId(); ?>"><?= $groupe->getNom() ?></a>
    <br />
<?php endforeach; ?>
