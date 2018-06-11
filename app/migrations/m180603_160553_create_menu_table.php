<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m180603_160553_create_menu_table extends Migration
{
    const TABLE_NAME = '{{%menu}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'icon' => $this->string(),
            'url' => $this->string(1000),
            'order' => $this->smallInteger()->defaultValue(0),   // 0 - no order
            'parent_id' => $this->integer()->defaultValue(0),    // 0 - no parent
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-menu-parent_id', self::TABLE_NAME, '[[parent_id]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-menu-parent_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
