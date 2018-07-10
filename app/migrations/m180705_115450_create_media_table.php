<?php

use yii\db\Migration;

/**
 * Handles the creation of table `media`.
 */
class m180705_115450_create_media_table extends Migration
{
    const TABLE_NAME = '{{%media}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'status' => $this->smallInteger(),
            'visibility' => $this->smallInteger(),
            'author_id' => $this->integer(),
            'upload_path' => $this->string(1000),
            'mime' => $this->string(),
            'caption' => $this->text(),
            'alt' => $this->string(),
            'desc' => $this->text(),
            'width' => $this->integer(),
            'height' => $this->integer(),
            'size' => $this->integer(),
            'originName' => $this->string(),
            'thumb_path' => $this->string(1000),
            'mime_icon' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-media-author_id', self::TABLE_NAME, '[[author_id]]');
        $this->createIndex('idx-media-status', self::TABLE_NAME, '[[status]]');
        $this->createIndex('idx-media-visibility', self::TABLE_NAME, '[[visibility]]');
        $this->createIndex('idx-media-mime', self::TABLE_NAME, '[[mime]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
