<?php

use yii\db\Migration;

/**
 * Class m210804_180743_message
 */
class m210804_180743_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(11)->notNull(),
            'sender_id' => $this->integer(11)->notNull(),
            'recipient_id' => $this->integer(11)->notNull(),
            'body' => $this->text()->notNull(),
            'was_read' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->datetime()->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('message');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_180743_message cannot be reverted.\n";

        return false;
    }
    */
}
