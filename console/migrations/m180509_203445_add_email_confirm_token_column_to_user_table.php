<?php

use yii\db\Migration;

/**
 * Handles adding email_confirm_token to table `user`.
 */
class m180509_203445_add_email_confirm_token_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'email_confirm_token', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'email_confirm_token');
    }
}
