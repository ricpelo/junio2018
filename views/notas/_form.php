<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notas */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="notas-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'alumno_id')->textInput() ?>
        <?= $form->field($model, 'asignatura_id')->dropdownList($listaAsignaturas) ?>
        <?= $form->field($model, 'trimestre')->textInput() ?>
        <?= $form->field($model, 'nota')->dropdownList(range(0, 10)) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
