<?php

use yii\db\Migration;

/**
 * Handles adding birth_date to table `user`.
 */
class m180517_182446_add_birth_date_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'birth_date', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'birth_date');
    }
}
