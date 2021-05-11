<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asignaturas}}`.
 */
class m210511_180335_create_asignaturas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%asignaturas}}', [
            'id' => $this->bigPrimaryKey(),
            'denominacion' => $this->string(),
            'trimestres' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asignaturas}}');
    }
}
