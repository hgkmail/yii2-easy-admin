<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180530_151123_create_user_table extends Migration
{
    const TABLE_NAME = '{{%user}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->unique()->notNull(),
            'email' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'auth_key' => $this->string(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
