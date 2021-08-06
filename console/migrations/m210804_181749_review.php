<?php

use yii\db\Migration;

/**
 * Class m210804_181749_review
 */
class m210804_181749_review extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('review', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(11)->notNull(),
            'customer_id' => $this->integer(11)->notNull(),
            'worker_id' => $this->integer(11)->notNull(),
            'body' => $this->text()->notNull(),
            'rate' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->datetime()->null()->defaultValue(null),
        ]);

        $this->createIndex(
            'idx-review-task',
            'review',
            'task_id'
        );
        $this->createIndex(
            'idx-review-customer',
            'review',
            'customer_id'
        );
        $this->createIndex(
            'idx-review-worker',
            'review',
            'worker_id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropIndex('idx-review-task','review');
        $this->dropIndex('idx-review-customer','review');
        $this->dropIndex('idx-review-worker','review');
        $this->dropTable('review');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_181749_review cannot be reverted.\n";

        return false;
    }
    */
}
