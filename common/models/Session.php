<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property int $client_id
 * @property string $ip
 * @property string $user_agent
 * @property string $created_at
 *
 * @property Client $client
 * @property Stat[] $stats
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id'], 'required'],
            [['client_id', 'ip'], 'integer'],
            [['user_agent'], 'string'],
            [['created_at'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Пользователь',
            'ip' => 'IP адрес',
            'user_agent' => 'User Agent',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStats()
    {
        return $this->hasMany(Stat::class, ['session_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->ip = $this->ip ? ip2long($this->ip) : null;

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->ip = $this->ip ? long2ip($this->ip) : null;

        parent::afterFind();
    }
}
