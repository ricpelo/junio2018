<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notas".
 *
 * @property int $alumno_id
 * @property int $asignatura_id
 * @property int $trimestre
 * @property int $nota
 *
 * @property Alumnos $alumno
 * @property Asignaturas $asignatura
 */
class Notas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumno_id', 'asignatura_id', 'trimestre', 'nota'], 'required'],
            [['alumno_id', 'asignatura_id', 'trimestre', 'nota'], 'default', 'value' => null],
            [['alumno_id', 'asignatura_id'], 'integer'],
            [['trimestre'], 'integer', 'min' => 1, 'max' => 3],
            [['nota'], 'integer', 'min' => 0, 'max' => 10],
            [['alumno_id', 'asignatura_id', 'trimestre'], 'unique', 'targetAttribute' => ['alumno_id', 'asignatura_id', 'trimestre']],
            [['alumno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumno_id' => 'id']],
            [['asignatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignaturas::class, 'targetAttribute' => ['asignatura_id' => 'id']],
            [['trimestre'], 'trimestreValido'],
        ];
    }

    public function trimestreValido($attribute, $params)
    {
        if ($this->trimestre > $this->asignatura->trimestres) {
            $this->addError($attribute, 'Trimestre incorrecto para esa asignatura.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alumno_id' => 'Alumno ID',
            'asignatura_id' => 'Asignatura ID',
            'trimestre' => 'Trimestre',
            'nota' => 'Nota',
        ];
    }

    /**
     * Gets query for [[Alumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(Alumnos::class, ['id' => 'alumno_id'])
            ->inverseOf('notas');
    }

    /**
     * Gets query for [[Asignatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignatura()
    {
        return $this->hasOne(Asignaturas::class, ['id' => 'asignatura_id'])
            ->inverseOf('notas');
    }
}
