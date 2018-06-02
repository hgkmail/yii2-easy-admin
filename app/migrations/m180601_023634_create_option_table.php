<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `option`.
 */
class m180601_023634_create_option_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%option}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'user_id' => $this->integer(),
            'key' => $this->string(),
            'value' => 'longtext',  // mysql
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk-option-user_id', '{{%option}}', '[[user_id]]',
            '{{%user}}', '[[id]]', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-option-user_id', '{{%option}}');
        $this->dropTable('{{%option}}');
    }
}
