<?php

use yii\db\Migration;

/**
 * Class m210804_183214_user
 */
class m210804_183214_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'email' => $this->string(256)->notNull()->unique(),
            'password' => $this->string(32)->notNull(),
            'birthday' => $this->datetime()->null(),
            'register_at' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'city_id' => $this->integer(11)->null(),
            'avatar' => $this->string(1024)->null(),
            'about' => $this->text()->null(),
            'phone' => $this->string(128)->null(),
            'skype' => $this->string(128)->null(),
            'telegram' => $this->string(128)->null(),
            'other_contact' => $this->text()->null(),
            'show_profile' => $this->smallInteger()->notNull()->defaultValue(0),
            'show_contacts' => $this->smallInteger()->notNull()->defaultValue(0),
            'notify_message' => $this->smallInteger()->notNull()->defaultValue(0),
            'notify_review' => $this->smallInteger()->notNull()->defaultValue(0),
            'notify_start' => $this->smallInteger()->notNull()->defaultValue(0),
            'notify_cancel' => $this->smallInteger()->notNull()->defaultValue(0),
            'notify_complete' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_183214_user cannot be reverted.\n";

        return false;
    }
    */
}
