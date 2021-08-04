<?php

use yii\db\Migration;

/**
 * Class m210804_185623_foreign_keys
 */
class m210804_185623_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_favorits_master',
            'favorits',
            'master_user_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_favorits_slave',
            'favorits',
            'slave_user_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_file_user',
            'file',
            'user_id',
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

        $this->addForeignKey(
            'fk_message_task',
            'message',
            'task_id',
            'task',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_message_sender',
            'message',
            'sender_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_message_recipient',
            'message',
            'recipient_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_response_task',
            'response',
            'task_id',
            'task',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_response_sender',
            'response',
            'worker_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_review_task',
            'review',
            'task_id',
            'task',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_review_customer',
            'review',
            'customer_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_review_worker',
            'review',
            'worker_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_task_category',
            'task',
            'category_id',
            'category',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_task_city',
            'task',
            'city_id',
            'city',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_task_customer',
            'task',
            'customer_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_task_worker',
            'task',
            'worker_id',
            'user',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_user_city',
            'user',
            'city_id',
            'city',
            'id',
            null,
            'cascade');

        $this->addForeignKey(
            'fk_user_category_cat',
            'user_category',
            'category_id',
            'category',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey(
            'fk_user_category_user',
            'user_category',
            'user_id',
            'user',
            'id',
            'cascade',
            'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_favorits_master', 'favorits');
        $this->dropForeignKey('fk_favorits_slave', 'favorits');
        $this->dropForeignKey('fk_file_user', 'file');
        $this->dropForeignKey('fk_file_task', 'file');
        $this->dropForeignKey('fk_message_task', 'message');
        $this->dropForeignKey('fk_message_sender', 'message');
        $this->dropForeignKey('fk_message_recipient', 'message');
        $this->dropForeignKey('fk_response_task', 'response');
        $this->dropForeignKey('fk_response_sender', 'response');
        $this->dropForeignKey('fk_review_task', 'review');
        $this->dropForeignKey('fk_review_customer', 'review');
        $this->dropForeignKey('fk_review_worker', 'review');
        $this->dropForeignKey('fk_task_category', 'task');
        $this->dropForeignKey('fk_task_city', 'task');
        $this->dropForeignKey('fk_task_customer', 'task');
        $this->dropForeignKey('fk_task_worker', 'task');
        $this->dropForeignKey('fk_user_city', 'user');
        $this->dropForeignKey('fk_user_category_cat', 'user_category');
        $this->dropForeignKey('fk_user_category_user', 'user_category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_185623_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
