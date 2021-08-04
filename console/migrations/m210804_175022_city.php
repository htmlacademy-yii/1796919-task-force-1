<?php

use yii\db\Migration;

/**
 * Class m210804_175022_city
 */
class m210804_175022_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),
            'coordinates' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_175022_city cannot be reverted.\n";

        return false;
    }
    */
}
