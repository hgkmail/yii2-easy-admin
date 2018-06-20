<?php

use yii\db\Migration;

/**
 * Handles the creation of table `inmail_received`.
 */
class m180620_090337_create_inmail_received_table extends Migration
{
    const TABLE_NAME = '{{%inmail_received}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'sent_id' => $this->integer(),
            'sender' => $this->string(),
            'receivers' => $this->text(),
            'receiver' => $this->string(),
            'subject' => $this->string(),
            'content' => 'longtext',
            'created_at' => $this->integer(),
            'read_at' => $this->integer()->defaultValue(0),
        ]);
        $this->createIndex('idx-inmail_received-sent_id', self::TABLE_NAME, '[[sent_id]]');
        $this->createIndex('idx-inmail_received-sender', self::TABLE_NAME, '[[sender]]');
        $this->createIndex('idx-inmail_received-receiver', self::TABLE_NAME, '[[receiver]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
