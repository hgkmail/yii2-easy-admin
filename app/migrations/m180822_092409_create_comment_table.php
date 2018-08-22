<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180822_092409_create_comment_table extends Migration
{
    const TABLE_NAME="{{%comment}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'user_id' => $this->integer(),
            'title' => $this->string(),
            'content' => 'longtext',
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk-comment-post_id', self::TABLE_NAME, '[[post_id]]',
            '{{%post}}', '[[id]]', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk-comment-user_id', self::TABLE_NAME, '[[user_id]]',
            '{{%user}}', '[[id]]', 'SET NULL', 'CASCADE');
        $this->createIndex('idx-comment-status', self::TABLE_NAME, '[[status]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-comment-post_id', self::TABLE_NAME);
        $this->dropForeignKey('fk-comment-user_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
