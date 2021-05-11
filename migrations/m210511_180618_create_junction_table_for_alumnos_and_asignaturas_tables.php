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
            'alumno_id' => $this->integer(),
            'asignatura_id' => $this->integer(),
            'trimestre' => $this->smallInteger(),
            'nota' => $this->smallInteger()->notNull(),
            'PRIMARY KEY(alumno_id, asignatura_id, trimestre)',
        ]);

        // creates index for column `alumno_id`
        $this->createIndex(
            '{{%idx-notas-alumno_id}}',
            '{{%notas}}',
            'alumno_id'
        );

        // add foreign key for table `{{%alumnos}}`
        $this->addForeignKey(
            '{{%fk-notas-alumno_id}}',
            '{{%notas}}',
            'alumno_id',
            '{{%alumnos}}',
            'id',
            'CASCADE'
        );

        // creates index for column `asignatura_id`
        $this->createIndex(
            '{{%idx-notas-asignatura_id}}',
            '{{%notas}}',
            'asignatura_id'
        );

        // add foreign key for table `{{%asignaturas}}`
        $this->addForeignKey(
            '{{%fk-notas-asignatura_id}}',
            '{{%notas}}',
            'asignatura_id',
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
            '{{%fk-notas-alumno_id}}',
            '{{%notas}}'
        );

        // drops index for column `alumno_id`
        $this->dropIndex(
            '{{%idx-notas-alumno_id}}',
            '{{%notas}}'
        );

        // drops foreign key for table `{{%asignaturas}}`
        $this->dropForeignKey(
            '{{%fk-notas-asignatura_id}}',
            '{{%notas}}'
        );

        // drops index for column `asignatura_id`
        $this->dropIndex(
            '{{%idx-notas-asignatura_id}}',
            '{{%notas}}'
        );

        $this->dropTable('{{%notas}}');
    }
}
