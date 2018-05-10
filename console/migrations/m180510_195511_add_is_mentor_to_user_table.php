<?php

use yii\db\Migration;

/**
 * Class m180510_195511_add_is_mentor_to_user_table
 */
class m180510_195511_add_is_mentor_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'isMentor', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'isMentor');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180510_195511_add_is_mentor_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
