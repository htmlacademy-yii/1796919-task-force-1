<?php

use yii\db\Migration;

/**
 * Class m210804_182133_task
 */
class m210804_182133_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string(1024)->notNull(),
            'description' => $this->text()->null(),
            'price' => $this->integer(11)->null(),
            'category_id' => $this->integer(11)->notNull(),
            'created_at' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'finish_at' => $this->datetime()->null()->defaultValue(null),
            'status' => "ENUM('new','canceled','working','fail','complete')",
            'coordinates' => $this->string(512)->notNull(),
            'city_id' => $this->integer(11)->notNull(),
            'customer_id' => $this->integer(11)->notNull(),
            'worker_id' => $this->integer(11)->notNull()
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('task');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_182133_task cannot be reverted.\n";

        return false;
    }
    */
}
