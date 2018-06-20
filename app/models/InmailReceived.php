<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%inmail_received}}".
 *
 * @property int $id
 * @property int $sent_id
 * @property string $sender
 * @property string $receivers
 * @property string $receiver
 * @property string $subject
 * @property string $content
 * @property int $created_at
 * @property int $read_at
 */
class InmailReceived extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inmail_received}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sent_id', 'created_at', 'read_at'], 'integer'],
            [['content'], 'string'],
            [['sender', 'receivers', 'subject', 'content'], 'required'],
            [['sender', 'receiver', 'subject'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sent_id' => Yii::t('app', 'Sent ID'),
            'sender' => Yii::t('app', 'Sender'),
            'receivers' => Yii::t('app', 'Receivers'),
            'receiver' => Yii::t('app', 'Receiver'),
            'subject' => Yii::t('app', 'Subject'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'read_at' => Yii::t('app', 'Read At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return InmailReceivedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InmailReceivedQuery(get_called_class());
    }

    public function getSenderUser()
    {
        return $this->hasOne(User::class, ['username' => 'sender']);
    }

    /**
     * @param Inmail $inmail
     * @param string $receiver
     * @return InmailReceived
     */
    public static function fromInmail($inmail, $receiver)
    {
        $received = new InmailReceived();
        $received->sender = $inmail->sender;
        $received->receivers = $inmail->receivers;
        $received->subject = $inmail->subject;
        $received->content = $inmail->content;
        $received->sent_id = $inmail->id;
        $received->receiver = $receiver;

        return $received;
    }
}
