<?php

use yii\db\Migration;

/**
 * Class m211030_142140_file_string_column
 */
class m211030_142140_file_string_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('file','unique_string', $this->string(32)->null());
        $this->dropForeignKey('fk_file_task', 'file');
        $this->dropForeignKey('fk_task_worker', 'task');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('file','unique_string');
        $this->addForeignKey(
            'fk_task_worker',
            'task',
            'worker_id',
            'user',
            'id',
            'cascade',
            'cascade');
        $this->addForeignKey(
            'fk_file_task',
            'file',
            'task_id',
            'task',
            'id',
            'cascade',
            'cascade');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211030_142140_file_string_column cannot be reverted.\n";

        return false;
    }
    */
}
