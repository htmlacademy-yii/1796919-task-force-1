<?php

use yii\db\Migration;

/**
 * Class m210804_184013_user_category
 */
class m210804_184013_user_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_category', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull()
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('user_category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_184013_user_category cannot be reverted.\n";

        return false;
    }
    */
}
