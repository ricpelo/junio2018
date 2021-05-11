<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notas}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%alumnos}}`
 * - `{{%asignaturas}}`
 */
class m210511_180618_create_junction_table_for_alumnos_and_asignaturas_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notas}}', [
            'alumnos_id' => $this->integer(),
            'asignaturas_id' => $this->integer(),
            'trimestre' => $this->smallInteger(),
            'nota' => $this->smallInteger()->notNull(),
            'PRIMARY KEY(alumnos_id, asignaturas_id, trimestre)',
        ]);

        // creates index for column `alumnos_id`
        $this->createIndex(
            '{{%idx-notas-alumnos_id}}',
            '{{%notas}}',
            'alumnos_id'
        );

        // add foreign key for table `{{%alumnos}}`
        $this->addForeignKey(
            '{{%fk-notas-alumnos_id}}',
            '{{%notas}}',
            'alumnos_id',
            '{{%alumnos}}',
            'id',
            'CASCADE'
        );

        // creates index for column `asignaturas_id`
        $this->createIndex(
            '{{%idx-notas-asignaturas_id}}',
            '{{%notas}}',
            'asignaturas_id'
        );

        // add foreign key for table `{{%asignaturas}}`
        $this->addForeignKey(
            '{{%fk-notas-asignaturas_id}}',
            '{{%notas}}',
            'asignaturas_id',
            '{{%asignaturas}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%alumnos}}`
        $this->dropForeignKey(
            '{{%fk-notas-alumnos_id}}',
            '{{%notas}}'
        );

        // drops index for column `alumnos_id`
        $this->dropIndex(
            '{{%idx-notas-alumnos_id}}',
            '{{%notas}}'
        );

        // drops foreign key for table `{{%asignaturas}}`
        $this->dropForeignKey(
            '{{%fk-notas-asignaturas_id}}',
            '{{%notas}}'
        );

        // drops index for column `asignaturas_id`
        $this->dropIndex(
            '{{%idx-notas-asignaturas_id}}',
            '{{%notas}}'
        );

        $this->dropTable('{{%notas}}');
    }
}
