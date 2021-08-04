<?php

use yii\db\Migration;

/**
 * Class m210804_175917_favorits
 */
class m210804_175917_favorits extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('favorits', [
            'id' => $this->primaryKey(),
            'master_user_id' => $this->integer(11)->notNull(),
            'slave_user_id' => $this->integer(11)->notNull(),
        ]);



        $this->createIndex(
            'idx-favorits-user',
            'favorits',
            ['master_user_id', 'slave_user_id']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropIndex('idx-favorits-user','favorits');
        $this->dropTable('favorits');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_175917_favorits cannot be reverted.\n";

        return false;
    }
    */
}
