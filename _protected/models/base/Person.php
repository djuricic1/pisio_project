<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "person".
 *
 * @property integer $id
 * @property string $name
 * @property string $jmbg
 * @property string $title
 * @property string $contact
 * @property string $employment
 * @property string $role_name
 *
 * @property \app\models\FixedAssets[] $fixedAssets
 * @property \app\models\Transfer[] $transfers
 */
class Person extends \yii\db\ActiveRecord
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
            'transfers'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'jmbg'], 'required'],
            [['name', 'title', 'contact', 'employment', 'role_name'], 'string', 'max' => 255],
            [['jmbg'], 'string', 'max' => 13]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'jmbg' => 'Jmbg',
            'title' => 'Title',
            'contact' => 'Contact',
            'employment' => 'Employment',
            'role_name' => 'Role Name',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFixedAssets()
    {
        return $this->hasMany(\app\models\FixedAssets::className(), ['person_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfers()
    {
        return $this->hasMany(\app\models\Transfer::className(), ['personIdTo' => 'id']);
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
     * @return \app\models\PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PersonQuery(get_called_class());
    }
}
