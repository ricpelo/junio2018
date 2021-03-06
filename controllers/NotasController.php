<?php

namespace app\controllers;

use app\models\Asignaturas;
use Yii;
use app\models\Notas;
use app\models\NotasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotasController implements the CRUD actions for Notas model.
 */
class NotasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notas model.
     * @param integer $alumno_id
     * @param integer $asignatura_id
     * @param integer $trimestre
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($alumno_id, $asignatura_id, $trimestre)
    {
        return $this->render('view', [
            'model' => $this->findModel($alumno_id, $asignatura_id, $trimestre),
        ]);
    }

    /**
     * Creates a new Notas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'alumno_id' => $model->alumno_id, 'asignatura_id' => $model->asignatura_id, 'trimestre' => $model->trimestre]);
        }

        return $this->render('create', [
            'model' => $model,
            'listaAsignaturas' => Asignaturas::lista(),
        ]);
    }

    /**
     * Updates an existing Notas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $alumno_id
     * @param integer $asignatura_id
     * @param integer $trimestre
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($alumno_id, $asignatura_id, $trimestre)
    {
        $model = $this->findModel($alumno_id, $asignatura_id, $trimestre);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'alumno_id' => $model->alumno_id, 'asignatura_id' => $model->asignatura_id, 'trimestre' => $model->trimestre]);
        }

        return $this->render('update', [
            'model' => $model,
            'listaAsignaturas' => Asignaturas::lista(),
        ]);
    }

    /**
     * Deletes an existing Notas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $alumno_id
     * @param integer $asignatura_id
     * @param integer $trimestre
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($alumno_id, $asignatura_id, $trimestre)
    {
        $this->findModel($alumno_id, $asignatura_id, $trimestre)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $alumno_id
     * @param integer $asignatura_id
     * @param integer $trimestre
     * @return Notas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alumno_id, $asignatura_id, $trimestre)
    {
        if (($model = Notas::findOne(['alumno_id' => $alumno_id, 'asignatura_id' => $asignatura_id, 'trimestre' => $trimestre])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
