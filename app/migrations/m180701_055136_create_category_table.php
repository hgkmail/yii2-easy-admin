<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180701_055136_create_category_table extends Migration
{
    const TABLE_NAME = '{{%category}}';

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
            'parent_id' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-category-status', self::TABLE_NAME, '[[status]]');
        $this->createIndex('idx-category-parent_id', self::TABLE_NAME, '[[parent_id]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
