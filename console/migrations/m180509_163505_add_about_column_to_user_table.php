<?php

use yii\db\Migration;

/**
 * Handles adding about to table `user`.
 */
class m180509_163505_add_about_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'about', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'about');
    }
}
