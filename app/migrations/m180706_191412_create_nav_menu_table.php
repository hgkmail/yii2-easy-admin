<?php

use yii\db\Migration;

/**
 * Handles the creation of table `nav_menu`.
 */
class m180706_191412_create_nav_menu_table extends Migration
{
    const TABLE_NAME = '{{%nav_menu}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'desc' => $this->text(),
            'location' => $this->string(20),
            'status' => $this->smallInteger(),
            'item_tree' => $this->json(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-nav_menu-status', self::TABLE_NAME, '[[status]]');
        $this->createIndex('idx-nav_menu-location', self::TABLE_NAME, '[[location]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
