<?php

use yii\db\Migration;

/**
 * Handles adding first_name to table `user`.
 */
class m180509_163413_add_first_name_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'first_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'first_name');
    }
}
