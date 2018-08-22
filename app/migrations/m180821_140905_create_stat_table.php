<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stat`.
 */
class m180821_140905_create_stat_table extends Migration
{
    const TABLE_NAME="{{%stat}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'item' => $this->string(),
            'result' => 'longtext',
            'updated_at' => $this->integer()->defaultValue(0),
        ]);
        $this->createIndex('idx-stat-item', self::TABLE_NAME, '[[item]]', true);

        // init data
        $this->insert(self::TABLE_NAME, ['item' => 'total-user']);
        $this->insert(self::TABLE_NAME, ['item' => 'total-role']);
        $this->insert(self::TABLE_NAME, ['item' => 'total-menu']);
        $this->insert(self::TABLE_NAME, ['item' => 'total-feedback']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
