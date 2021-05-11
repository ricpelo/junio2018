<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notas */

$this->title = 'Update Notas: ' . $model->alumno_id;
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->alumno_id, 'url' => ['view', 'alumno_id' => $model->alumno_id, 'asignatura_id' => $model->asignatura_id, 'trimestre' => $model->trimestre]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listaAsignaturas' => $listaAsignaturas,
    ]) ?>

</div>
