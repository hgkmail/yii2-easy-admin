<?php

use yii\db\Migration;

/**
 * Class m180604_065513_init_rbac_data
 */
class m180604_065513_init_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $sub = $auth->createRole('subscriber');
        $sub->description = 'subscriber can only read and edit profile';
        $auth->add($sub);

        $contributor = $auth->createRole('contributor');
        $contributor->description = 'contributor can edit own post and delete own post';
        $auth->add($contributor);
        $auth->addChild($contributor, $sub);

        $author = $auth->createRole('author');
        $author->description = 'author can publish own post';
        $auth->add($author);
        $auth->addChild($author, $contributor);

        $editor = $auth->createRole('editor');
        $editor->description = 'editor can manage all content, include page and others';
        $auth->add($editor);
        $auth->addChild($editor, $author);

        $admin = $auth->createRole('admin');
        $admin->description = 'admin can manage website settings';
        $auth->add($admin);
        $auth->addChild($admin, $editor);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
