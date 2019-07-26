<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "stat".
 *
 * @property int $id
 * @property int $session_id
 * @property string $motion
 * @property double $light
 * @property int $battery
 * @property string $created_at
 *
 * @property Session $session
 */
class Stat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id'], 'required'],
            [['session_id', 'battery'], 'integer'],
            [['light'], 'number'],
            [['motion'], 'string', 'max' => 255],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::class, 'targetAttribute' => ['session_id' => 'id']],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Session ID',
            'motion' => 'Акселерометр',
            'light' => 'Освещенность',
            'battery' => 'Заряд батареи',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::class, ['id' => 'session_id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->motion = $this->motion ? json_encode($this->motion) : null;

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->motion = $this->motion ? json_decode($this->motion, true) : null;

        parent::afterFind();
    }
}
