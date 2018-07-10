<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m180622_164251_create_tag_table extends Migration
{
    const TABLE_NAME = '{{%tag}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'desc' => $this->text(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-tag-status', self::TABLE_NAME, '[[status]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
