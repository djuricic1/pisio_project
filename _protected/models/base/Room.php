<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "room".
 *
 * @property integer $id
 * @property string $number
 * @property string $name
 * @property integer $building_id
 *
 * @property \app\models\FixedAssets[] $fixedAssets
 * @property \app\models\Building $building
 * @property \app\models\Transfer[] $transfers
 */
class Room extends \yii\db\ActiveRecord
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
            'building',
            'transfers'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'name', 'building_id'], 'required'],
            [['building_id'], 'integer'],
            [['number', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'name' => 'Name',
            'building_id' => 'Building ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFixedAssets()
    {
        return $this->hasMany(\app\models\FixedAssets::className(), ['room_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(\app\models\Building::className(), ['id' => 'building_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfers()
    {
        return $this->hasMany(\app\models\Transfer::className(), ['roomIdTo' => 'id']);
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
     * @return \app\models\RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RoomQuery(get_called_class());
    }
}
