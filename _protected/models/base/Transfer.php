<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "transfer".
 *
 * @property integer $id
 * @property string $dateCreated
 * @property integer $fixed_assets_id
 * @property integer $personIdFrom
 * @property integer $personIdTo
 * @property integer $roomIdFrom
 * @property integer $roomIdTo
 *
 * @property \app\models\FixedAssets $fixedAssets
 * @property \app\models\Person $personIdFrom0
 * @property \app\models\Person $personIdTo0
 * @property \app\models\Room $roomIdFrom0
 * @property \app\models\Room $roomIdTo0
 */
class Transfer extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'fixedAssets',
            'personIdFrom0',
            'personIdTo0',
            'roomIdFrom0',
            'roomIdTo0'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateCreated', 'fixed_assets_id'], 'required'],
            [['dateCreated'], 'safe'],
            [['fixed_assets_id', 'personIdFrom', 'personIdTo', 'roomIdFrom', 'roomIdTo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dateCreated' => 'Date Created',
            'fixed_assets_id' => 'Fixed Assets ID',
            'personIdFrom' => 'Person Id From',
            'personIdTo' => 'Person Id To',
            'roomIdFrom' => 'Room Id From',
            'roomIdTo' => 'Room Id To',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFixedAssets()
    {
        return $this->hasOne(\app\models\FixedAssets::className(), ['id' => 'fixed_assets_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonIdFrom0()
    {
        return $this->hasOne(\app\models\Person::className(), ['id' => 'personIdFrom']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonIdTo0()
    {
        return $this->hasOne(\app\models\Person::className(), ['id' => 'personIdTo']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomIdFrom0()
    {
        return $this->hasOne(\app\models\Room::className(), ['id' => 'roomIdFrom']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomIdTo0()
    {
        return $this->hasOne(\app\models\Room::className(), ['id' => 'roomIdTo']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \app\models\TransferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\TransferQuery(get_called_class());
    }
}
