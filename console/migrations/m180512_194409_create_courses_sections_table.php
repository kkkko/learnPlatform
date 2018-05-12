<?php

use yii\db\Migration;

/**
 * Handles the creation of table `courses_sections`.
 */
class m180512_194409_create_courses_sections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('courses_sections', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer(),
            'section_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('courses_sections');
    }
}
