<?php

use yii\db\Migration;

/**
 * Class m180510_195452_add_is_admin_to_user_table
 */
class m180510_195452_add_is_admin_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'isAdmin', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'isAdmin');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180510_195452_add_is_admin_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
