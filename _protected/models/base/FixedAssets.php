<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "fixed_assets".
 *
 * @property integer $id
 * @property integer $number
 * @property string $status
 * @property string $description
 * @property string $purchaseDate
 * @property string $initialPrice
 * @property integer $amortization
 * @property integer $person_id
 * @property integer $category_id
 * @property integer $room_id
 *
 * @property \app\models\Category $category
 * @property \app\models\Person $person
 * @property \app\models\Room $room
 * @property \app\models\Transfer[] $transfers
 */
class FixedAssets extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'category',
            'person',
            'room',
            'transfers'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'status', 'description', 'purchaseDate', 'initialPrice', 'amortization', 'category_id'], 'required'],
            [['number', 'amortization', 'person_id', 'category_id', 'room_id'], 'integer'],
            [['purchaseDate'], 'safe'],
            [['initialPrice'], 'number'],
            [['status'], 'string', 'max' => 1],
            [['description'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fixed_assets';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'status' => 'Status',
            'description' => 'Description',
            'purchaseDate' => 'Purchase Date',
            'initialPrice' => 'Initial Price',
            'amortization' => 'Amortization',
            'person_id' => 'Person ID',
            'category_id' => 'Category ID',
            'room_id' => 'Room ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(\app\models\Category::className(), ['id' => 'category_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(\app\models\Person::className(), ['id' => 'person_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(\app\models\Room::className(), ['id' => 'room_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfers()
    {
        return $this->hasMany(\app\models\Transfer::className(), ['fixed_assets_id' => 'id']);
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
     * @return \app\models\FixedAssetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\FixedAssetsQuery(get_called_class());
    }
}
