<?php

use yii\db\Migration;

/**
 * Handles the creation of table `like`.
 */
class m180822_104109_create_like_table extends Migration
{
    const TABLE_NAME = '{{%like}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk-like-post_id', self::TABLE_NAME, '[[post_id]]',
            '{{%post}}', '[[id]]', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk-like-user_id', self::TABLE_NAME, '[[user_id]]',
            '{{%user}}', '[[id]]', 'SET NULL', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-like-post_id', self::TABLE_NAME);
        $this->dropForeignKey('fk-like-user_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
