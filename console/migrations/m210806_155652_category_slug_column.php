<?php

use yii\db\Migration;

/**
 * Class m210806_155652_category_slug_column
 */
class m210806_155652_category_slug_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'slug', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'slug');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210806_155652_category_slug_column cannot be reverted.\n";

        return false;
    }
    */
}
