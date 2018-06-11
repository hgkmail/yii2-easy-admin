<?php

use yii\db\Migration;

/**
 * Handles the creation of table `operation_log`.
 */
class m180603_181812_create_operation_log_table extends Migration
{
    const TABLE_NAME = '{{%operation_log}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'ip' => $this->string(),
            'path' => $this->string(1000),
            'input' => $this->text(),
            'method' => $this->string(),
            'description' => $this->string(),
        ]);
        $this->createIndex(
            'idx-operation_log-user_id',
            self::TABLE_NAME,
            '[[user_id]]'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-operation_log-user_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
