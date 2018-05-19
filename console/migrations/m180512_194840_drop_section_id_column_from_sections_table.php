<?php

use yii\db\Migration;

/**
 * Handles dropping section_id from table `sections`.
 */
class m180512_194840_drop_section_id_column_from_sections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('sections', 'course_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('sections', 'course_id', $this->text());
    }
}
