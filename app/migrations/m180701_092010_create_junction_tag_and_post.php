<?php

use yii\db\Migration;

/**
 * Class m180701_092010_create_junction_tag_and_post
 */
class m180701_092010_create_junction_tag_and_post extends Migration
{
    const TABLE_NAME = '{{%tag_post}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'tag_id' => $this->integer(),
            'post_id' => $this->integer(),
            'PRIMARY KEY([[tag_id]], [[post_id]])',
        ]);
        $this->addForeignKey(
            'fk-tag_post-tag_id',
            self::TABLE_NAME,
            '[[tag_id]]',
            '{{%tag}}',
            '[[id]]',
            'CASCADE',
            'CASCADE');
        $this->addForeignKey(
            'fk-tag_post-post_id',
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
        $this->dropForeignKey('fk-tag_post-tag_id', self::TABLE_NAME);
        $this->dropForeignKey('fk-tag_post-post_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }

}
