<?php

namespace app\models;

use app\base\TreeModelTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $cover
 * @property int $status
 * @property int $visibility
 * @property int $author_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $parent_id
 * @property int $order
 */
class Page extends ActiveRecord
{
    use TreeModelTrait;

    const STATUS_DRAFT = 1;              // draft
    const STATUS_PENDING_REVIEW = 2;     // pending review
    const STATUS_PUBLISH = 3;            // publish

    const VISIBILITY_PUBLIC = 1;         // public
    const VISIBILITY_PRIVATE = 2;        // private

    public $children = [];   // for display

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%page}}';
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
    public function rules()
    {
        return [
            [['title', 'author_id'], 'required'],
            [['content'], 'string'],
            [['status', 'visibility', 'author_id', 'created_at', 'updated_at', 'parent_id', 'order'], 'integer'],
            [['title', 'cover'], 'string', 'max' => 255],
            [['parent_id', 'order'], 'default', 'value' => 0],
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
            'status' => Yii::t('app', 'Status'),
            'visibility' => Yii::t('app', 'Visibility'),
            'author_id' => Yii::t('app', 'Author'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'parent_id' => Yii::t('app', 'Parent'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }
}
