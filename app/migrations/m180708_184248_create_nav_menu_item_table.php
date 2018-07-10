<?php

use yii\db\Migration;

/**
 * Handles the creation of table `nav_menu_item`.
 */
class m180708_184248_create_nav_menu_item_table extends Migration
{
    const TABLE_NAME = '{{%nav_menu_item}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'pk_id' => $this->primaryKey(),
            'id' => $this->bigInteger(),
            'label' => $this->string(),
            'icon' => $this->string(),
            'action' => $this->string(),
            'target' => $this->string(),
            'extra' => $this->string(),
            'menu_id' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-nav_menu_item-id', self::TABLE_NAME, '[[id]]');
        $this->createIndex('idx-nav_menu_item-status', self::TABLE_NAME, '[[status]]');
        $this->addForeignKey(
            'fk-nav_menu_item-menu_id',
            self::TABLE_NAME,
            '[[menu_id]]',
            '{{%nav_menu}}',
            '[[id]]',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-nav_menu_item-menu_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
