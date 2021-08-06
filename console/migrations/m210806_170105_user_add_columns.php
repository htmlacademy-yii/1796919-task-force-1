<?php

use yii\db\Migration;

/**
 * Class m210806_170105_user_add_columns
 */
class m210806_170105_user_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', "ENUM('worker','customer')");
        $this->addColumn('user', 'activity', $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role');
        $this->dropColumn('user', 'activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210806_170105_user_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
