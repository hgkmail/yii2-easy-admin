<?php

namespace app\models;

use app\base\FileUtil;
use Exception;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%media}}".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property int $visibility
 * @property int $author_id
 * @property string $upload_path
 * @property string $mime
 * @property string $caption
 * @property string $alt
 * @property string $desc
 * @property int width
 * @property int height
 * @property int size
 * @property string originName
 * @property string thumb_path
 * @property string mime_icon
 * @property int $created_at
 * @property int $updated_at
 */
class Media extends ActiveRecord
{
    const STATUS_ENABLED= 1;
    const STATUS_DISABLED = 2;

    const VISIBILITY_PUBLIC = 1;         // public
    const VISIBILITY_PRIVATE = 2;        // private

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => false,
                'value' => null,
                'defaultValue' => 0,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'visibility', 'author_id', 'created_at', 'updated_at',
                'width', 'height', 'size'], 'integer'],
            [['caption', 'desc'], 'string'],
            [['title', 'mime', 'alt', 'originName', 'mime_icon'], 'string', 'max' => 255],
            [['upload_path', 'thumb_path'], 'string', 'max' => 1000],
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
            'status' => Yii::t('app', 'Status'),
            'visibility' => Yii::t('app', 'Visibility'),
            'author_id' => Yii::t('app', 'Author ID'),
            'upload_path' => Yii::t('app', 'Upload Path'),
            'mime' => Yii::t('app', 'MIME'),
            'caption' => Yii::t('app', 'Caption'),
            'alt' => Yii::t('app', 'Alt'),
            'desc' => Yii::t('app', 'Desc'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'size' => Yii::t('app', 'Size'),
            'thumb_path' => Yii::t('app', 'Thumb Path'),
            'mime_icon' => Yii::t('app', 'MIME Icon'),
            'originName' => Yii::t('app', 'Origin Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MediaQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Set MIME ( width and height if image )
     * @param string absolute
     */
    public function setMIME($filename)
    {
        $this->mime = mime_content_type($filename);
        $this->mime_icon = FileUtil::getIconByMIME($this->mime);
        if(strpos('mime-'.$this->mime, 'image/')!=FALSE) {
            $info = getimagesize($filename);
            $this->width = $info[0];
            $this->height = $info[1];
            try {
                $t_path = FileUtil::generateThumbnail($filename, 130, 130, 80);
                $this->thumb_path = substr($t_path, strpos($t_path, '/upload/'));
            } catch (Exception $e) {
                $this->thumb_path = '';
            }
        }
    }
}
