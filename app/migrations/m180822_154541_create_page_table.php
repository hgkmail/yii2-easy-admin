<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m180822_154541_create_page_table extends Migration
{
    const TABLE_NAME = '{{%page}}';

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
            'status' => $this->smallInteger(),
            'visibility' => $this->smallInteger(),
            'author_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'parent_id' => $this->integer()->defaultValue(0),
            'order' => $this->integer()->defaultValue(0),
        ]);
        $this->createIndex('idx-page-author_id', self::TABLE_NAME, '[[author_id]]');
        $this->createIndex('idx-page-status', self::TABLE_NAME, '[[status]]');
        $this->createIndex('idx-page-visibility', self::TABLE_NAME, '[[visibility]]');
        $this->createIndex('idx-page-parent_id', self::TABLE_NAME, '[[parent_id]]');
        $this->createIndex('idx-page-order', self::TABLE_NAME, '[[order]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
