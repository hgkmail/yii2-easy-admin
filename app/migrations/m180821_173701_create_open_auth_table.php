<?php

use yii\db\Migration;

/**
 * Handles the creation of table `open_auth`.
 */
class m180821_173701_create_open_auth_table extends Migration
{
    const TABLE_NAME = "{{%open_auth}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'source' => $this->string(30),
            'source_id' => $this->string(30),
        ]);

        $this->addForeignKey('fk-open_auth-user_id', self::TABLE_NAME, '[[user_id]]',
            '{{%user}}', '[[id]]', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-open_auth-source', self::TABLE_NAME, '[[source]]');
        $this->createIndex('idx-open_auth-source_id', self::TABLE_NAME, '[[source_id]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-open_auth-user_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
