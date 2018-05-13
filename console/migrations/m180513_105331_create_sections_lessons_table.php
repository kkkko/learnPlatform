<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sections_lessons`.
 */
class m180513_105331_create_sections_lessons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sections_lessons', [
            'id' => $this->primaryKey(),
            'section_id' => $this->integer(),
            'lesson_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sections_lessons');
    }
}
