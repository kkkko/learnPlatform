<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sections`.
 */
class m180511_123041_create_sections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sections', [
            'id' => $this->primaryKey(),
            'course_id' => $this->string(),
            'title' => $this->string(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sections');
    }
}
