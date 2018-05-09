<?php

use yii\db\Migration;

/**
 * Handles adding phone_number to table `user`.
 */
class m180509_163525_add_phone_number_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone_number', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone_number');
    }
}
