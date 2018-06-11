<?php

use yii\db\Migration;

/**
 * Class m180603_163240_create_junction_role_and_menu
 */
class m180603_163240_create_junction_role_and_menu extends Migration
{
    const TABLE_NAME = '{{%role_menu}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'role_name' => $this->string(64),
            'menu_id' => $this->integer(),
            'created_at' => $this->integer(),
            'PRIMARY KEY([[role_name]], [[menu_id]])',
        ]);

        $this->addForeignKey(
            'fk-role_menu-role_name',
            self::TABLE_NAME,
            '[[role_name]]',
            '{{%auth_item}}',
            '[[name]]',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-role_menu-menu_id',
            self::TABLE_NAME,
            '[[menu_id]]',
            '{{%menu}}',
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
        $this->dropForeignKey(
            'fk-role_menu-role_name',
            self::TABLE_NAME
        );

        $this->dropForeignKey(
            'fk-role_menu-menu_id',
            self::TABLE_NAME
        );

        $this->dropTable(self::TABLE_NAME);
    }
}
