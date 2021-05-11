<?php

namespace app\controllers;

use app\models\Asignaturas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FinalesController extends Controller
{
    public function actionIndex($asignatura_id)
    {
        $asignatura = $this->findAsignatura($asignatura_id);
        $dataProvider = new ActiveDataProvider([
            'query' => $asignatura->getAlumnos(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'asignatura' => $asignatura,
        ]);
    }

    protected function findAsignatura($id)
    {
        if (($model = Asignaturas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La asignatura no existe');
    }
}
