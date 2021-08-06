<?php

use yii\db\Migration;

/**
 * Class m210804_181442_response
 */
class m210804_181442_response extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('response', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(11)->notNull(),
            'worker_id' => $this->integer(11)->notNull(),
            'comment' => $this->text()->notNull(),
            'price' => $this->integer(11)->notNull(),
            'created_at' => $this->datetime()->null()->defaultValue(null),
        ]);



        $this->createIndex(
            'idx-response-task',
            'response',
            'task_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-response-task','response');
        $this->dropTable('response');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_181442_response cannot be reverted.\n";

        return false;
    }
    */
}
