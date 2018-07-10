<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $cover
 * @property int $commentStatus
 * @property int $status
 * @property int $visibility
 * @property int $author_id
 * @property int $created_at
 * @property int $updated_at
 *
 */
class Post extends ActiveRecord
{
    const STATUS_DRAFT = 1;              // draft
    const STATUS_PENDING_REVIEW = 2;     // pending review
    const STATUS_PUBLISH = 3;            // publish

    const VISIBILITY_PUBLIC = 1;         // public
    const VISIBILITY_PRIVATE = 2;        // private

    const COMMENT_OPEN = 1;              // open comment
    const COMMENT_CLOSE = 2;             // close comment

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['commentStatus', 'status', 'visibility', 'author_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'cover'], 'string', 'max' => 255],
            [['title'], 'required'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'cover' => Yii::t('app', 'Cover'),
            'commentStatus' => Yii::t('app', 'Comment Status'),
            'status' => Yii::t('app', 'Status'),
            'visibility' => Yii::t('app', 'Visibility'),
            'author_id' => Yii::t('app', 'Author ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('{{%tag_post}}', ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->viaTable('{{%category_post}}',
            ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
