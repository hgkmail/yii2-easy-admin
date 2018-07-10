<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m180701_090907_create_post_table extends Migration
{
    const TABLE_NAME = '{{%post}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => 'longtext',
            'cover' => $this->string(),
            'commentStatus' => $this->smallInteger(),
            'status' => $this->smallInteger(),
            'visibility' => $this->smallInteger(),
            'author_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-post-author_id', self::TABLE_NAME, '[[author_id]]');
        $this->createIndex('idx-post-status', self::TABLE_NAME, '[[status]]');
        $this->createIndex('idx-post-visibility', self::TABLE_NAME, '[[visibility]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
