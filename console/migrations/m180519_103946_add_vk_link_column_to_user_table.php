<?php

use yii\db\Migration;

/**
 * Handles adding vk_link to table `uer`.
 */
class m180519_103946_add_vk_link_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'vk_link', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'vk_link');
    }
}
