<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_profile`.
 */
class m180603_190137_create_user_profile_table extends Migration
{
    const TABLE_NAME = "{{%user_profile}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'user_id' => $this->integer()->notNull(),
            'nickname' => $this->string(),
            'gender' => $this->smallInteger(),
            'avatar' => $this->string(1000),
            'phone_number' => $this->string(),
            'birthday' => $this->date(),
            'description' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY([[user_id]])',
        ]);
        $this->addForeignKey(
            'fk-user_profile-user_id',
            self::TABLE_NAME,
            '[[user_id]]',
            '{{%user}}',
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
        $this->dropForeignKey('fk-user_profile-user_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
