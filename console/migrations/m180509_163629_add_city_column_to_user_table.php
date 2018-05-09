<?php

use yii\db\Migration;

/**
 * Handles adding city to table `user`.
 */
class m180509_163629_add_city_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'city', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'city');
    }
}
