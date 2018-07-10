<?php

use yii\db\Migration;

/**
 * Class m180701_094655_create_junction_category_and_post
 */
class m180701_094655_create_junction_category_and_post extends Migration
{
    const TABLE_NAME = '{{%category_post}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'category_id' => $this->integer(),
            'post_id' => $this->integer(),
            'PRIMARY KEY([[category_id]], [[post_id]])',
        ]);
        $this->addForeignKey(
            'fk-category_post-category_id',
            self::TABLE_NAME,
            '[[category_id]]',
            '{{%category}}',
            '[[id]]',
            'CASCADE',
            'CASCADE');
        $this->addForeignKey(
            'fk-category_post-post_id',
            self::TABLE_NAME,
            '[[post_id]]',
            '{{%post}}',
            '[[id]]',
            'CASCADE',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-category_post-category_id', self::TABLE_NAME);
        $this->dropForeignKey('fk-category_post-post_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
