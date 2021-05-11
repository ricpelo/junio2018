<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notas */

$this->title = $model->alumno_id;
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'alumno_id' => $model->alumno_id, 'asignatura_id' => $model->asignatura_id, 'trimestre' => $model->trimestre], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'alumno_id' => $model->alumno_id, 'asignatura_id' => $model->asignatura_id, 'trimestre' => $model->trimestre], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'alumno_id',
            'asignatura_id',
            'trimestre',
            'nota',
        ],
    ]) ?>

</div>
