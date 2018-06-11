<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feedback`.
 */
class m180609_125201_create_feedback_table extends Migration
{
    const TABLE_NAME = '{{%feedback}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'title' => $this->string(),
            'content' => 'longtext',
            'score' => $this->smallInteger(),
            'created_at' => $this->integer(),
        ]);
        $this->createIndex(
            'idx-feedback-user_id',
            self::TABLE_NAME,
            '[[user_id]]'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-feedback-user_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
