<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%alumnos}}`.
 */
class m210511_180156_create_alumnos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%alumnos}}', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%alumnos}}');
    }
}
