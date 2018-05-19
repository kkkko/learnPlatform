<?php

use yii\db\Migration;

/**
 * Handles adding fb_link to table `uer`.
 */
class m180519_103929_add_fb_link_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'fb_link', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'fb_link');
    }
}
