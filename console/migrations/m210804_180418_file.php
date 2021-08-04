<?php

use yii\db\Migration;

/**
 * Class m210804_180418_file
 */
class m210804_180418_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'task_id' => $this->integer(11)->notNull(),
            'path' => $this->string(255)->notNull(),
        ]);

        $this->createIndex(
            'idx-file-user',
            'file',
            'user_id'
        );
        $this->createIndex(
            'idx-file-task',
            'file',
            'task_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropIndex('idx-file-user','file');
        $this->dropIndex('idx-file-task','file');
        $this->dropTable('file');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_180418_file cannot be reverted.\n";

        return false;
    }
    */
}
