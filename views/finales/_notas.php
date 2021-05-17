<?php

use yii\bootstrap4\Html;
?>

<h2><?= Html::encode($asignatura->denominacion) ?></h2>

<table class="table">
    <thead>
        <th>Alumno</th>
        <th>Primera</th>
        <th>Segunda</th>
        <th>Tercera</th>
        <th>Final</th>
    </thead>
    <tbody>
        <?php foreach ($finales as $final): ?>
            <tr>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <td><?= Html::encode($final[$i]) ?></td>
                <?php endfor ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
