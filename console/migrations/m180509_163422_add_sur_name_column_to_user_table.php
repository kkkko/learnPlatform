<?php

use yii\db\Migration;

/**
 * Handles adding sur_name to table `user`.
 */
class m180509_163422_add_sur_name_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'sur_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'sur_name');
    }
}
