<?php

use yii\db\Migration;

/**
 * Handles adding country to table `user`.
 */
class m180509_163619_add_country_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'country', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'country');
    }
}
