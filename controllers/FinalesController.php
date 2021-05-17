<?php

namespace app\controllers;

use app\models\Alumnos;
use app\models\Asignaturas;
use app\models\Notas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FinalesController extends Controller
{
    public function actionIndex($asignatura_id)
    {
        $asignatura = $this->findAsignatura($asignatura_id);
        $notas = [];
        $nombres = [];

        for ($i = 1; $i <= 3; $i++) {
            $notas[$i] = Notas::find()
            ->select('nota, alumno_id')
            ->where([
                'asignatura_id' => $asignatura_id,
                'trimestre' => $i,
            ])
            ->indexBy('alumno_id')
            ->column();
        }

        $nombres = Alumnos::find()
            ->select('nombre, id')
            ->indexBy('id')
            ->column();

        $finales = [];

        foreach ($nombres as $alumno_id => $nombre) {
            $nota1 = isset($notas[1][$alumno_id]) ? $notas[1][$alumno_id] : null;
            $nota2 = isset($notas[2][$alumno_id]) ? $notas[2][$alumno_id] : null;
            $nota3 = isset($notas[3][$alumno_id]) ? $notas[3][$alumno_id] : null;
            $media = ($nota1 + $nota2 + $nota3) / $asignatura->trimestres;

            $final = [$nombre, $nota1, $nota2, $nota3, $media];
            $finales[] = $final;
        }

        return $this->render('index', [
            'finales' => $finales,
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
