<?php

use yii\db\Migration;

/**
 * Handles the creation of table `inmail`.
 */
class m180619_095106_create_inmail_table extends Migration
{
    const TABLE_NAME = '{{%inmail}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'sender' => $this->string(),
            'receivers' => $this->text(),
            'subject' => $this->string(),
            'content' => 'longtext',
            'created_at' => $this->integer(),
        ]);
        $this->createIndex('idx-inmail-sender', self::TABLE_NAME, '[[sender]]');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
