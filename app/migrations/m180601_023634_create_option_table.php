<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `option`.
 */
class m180601_023634_create_option_table extends Migration
{
    const TABLE_NAME = '{{%option}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'user_id' => $this->integer(),
            'key' => $this->string(),
            'value' => 'longtext',  // mysql
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk-option-user_id', self::TABLE_NAME, '[[user_id]]',
            '{{%user}}', '[[id]]', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-option-type', self::TABLE_NAME, '[[type]]');
        $this->createIndex('idx-option-key', self::TABLE_NAME, '[[key]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-option-user_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
