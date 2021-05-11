<?php

use app\models\Notas;
use yii\grid\GridView;

$this->title = 'Notas finales';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre',
        [
            'value' => function ($model, $key, $index, $column) use ($asignatura) {
                return Notas::find()->select('nota')->where([
                    'alumno_id' => $model->id,
                    'asignatura_id' => $asignatura->id,
                    'trimestre' => 1,
                ])->scalar();
            }
        ],
        [
            'value' => function ($model, $key, $index, $column) use ($asignatura) {
                return Notas::find()->select('nota')->where([
                    'alumno_id' => $model->id,
                    'asignatura_id' => $asignatura->id,
                    'trimestre' => 2,
                ])->scalar();
            }
        ],
        [
            'value' => function ($model, $key, $index, $column) use ($asignatura) {
                return Notas::find()->select('nota')->where([
                    'alumno_id' => $model->id,
                    'asignatura_id' => $asignatura->id,
                    'trimestre' => 3,
                ])->scalar();
            }
        ],
    ],
]) ?>
