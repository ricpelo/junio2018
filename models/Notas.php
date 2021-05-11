<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notas".
 *
 * @property int $alumnos_id
 * @property int $asignaturas_id
 * @property int $trimestre
 * @property int $nota
 *
 * @property Alumnos $alumnos
 * @property Asignaturas $asignaturas
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
            [['alumnos_id', 'asignaturas_id', 'trimestre', 'nota'], 'required'],
            [['alumnos_id', 'asignaturas_id', 'trimestre', 'nota'], 'default', 'value' => null],
            [['alumnos_id', 'asignaturas_id', 'trimestre'], 'integer'],
            [['nota'], 'integer', 'min' => 0, 'max' => 10],
            [['alumnos_id', 'asignaturas_id', 'trimestre'], 'unique', 'targetAttribute' => ['alumnos_id', 'asignaturas_id', 'trimestre']],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['asignaturas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignaturas::class, 'targetAttribute' => ['asignaturas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alumnos_id' => 'Alumnos ID',
            'asignaturas_id' => 'Asignaturas ID',
            'trimestre' => 'Trimestre',
            'nota' => 'Nota',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(Alumnos::class, ['id' => 'alumnos_id'])
            ->inverseOf('notas');
    }

    /**
     * Gets query for [[Asignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignatura()
    {
        return $this->hasOne(Asignaturas::class, ['id' => 'asignaturas_id'])
            ->inverseOf('notas');
    }
}
