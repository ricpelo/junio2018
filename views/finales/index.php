<?php
$this->title = 'Notas finales';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="tabla">
    <?= $this->render('_notas', [
        'finales' => $finales,
        'asignatura' => $asignatura,
    ]) ?>
</div>
