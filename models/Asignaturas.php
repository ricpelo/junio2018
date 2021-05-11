<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asignaturas".
 *
 * @property int $id
 * @property string|null $denominacion
 * @property int|null $trimestres
 *
 * @property Notas[] $notas
 */
class Asignaturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignaturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trimestres'], 'default', 'value' => null],
            [['trimestres'], 'integer', 'min' => 2, 'max' => 3],
            [['denominacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Denominacion',
            'trimestres' => 'Trimestres',
        ];
    }

    /**
     * Gets query for [[Notas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Notas::class, ['asignatura_id' => 'id'])
            ->inverseOf('asignaturas');
    }

    public static function lista()
    {
        return static::find()
            ->select('denominacion')
            ->indexBy('id')
            ->orderBy('denominacion')
            ->column();
    }
}
