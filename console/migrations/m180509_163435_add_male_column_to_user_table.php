<?php

use yii\db\Migration;

/**
 * Handles adding male to table `user`.
 */
class m180509_163435_add_male_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'male', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'male');
    }
}
